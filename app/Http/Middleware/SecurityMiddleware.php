<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use App\Services\TokenService;
use App\Models\LoginActivity;
use Symfony\Component\HttpFoundation\Response;

class SecurityMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Add security headers
        $response = $next($request);
        
        $this->addSecurityHeaders($response);
        
        // Log suspicious activity
        $this->logSuspiciousActivity($request);
        
        // Rate limiting check
        if ($this->isRateLimited($request)) {
            Log::warning('Rate limit exceeded', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'endpoint' => $request->path(),
            ]);
            
            return response()->json([
                'error' => 'Too many requests. Please try again later.',
                'message' => 'Rate limit exceeded'
            ], 429);
        }
        
        // Validate session for authenticated routes
        if ($request->user() && $this->isSessionCompromised($request)) {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return response()->json([
                'error' => 'Session expired. Please login again.',
                'message' => 'Security validation failed'
            ], 401);
        }
        
        return $response;
    }

    /**
     * Add security headers to response
     */
    private function addSecurityHeaders($response): void
    {
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Content-Security-Policy', "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline'; img-src 'self' data: https:; font-src 'self' https:; connect-src 'self'");
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=(), camera=()');
    }

    /**
     * Log suspicious activity patterns
     */
    private function logSuspiciousActivity(Request $request): void
    {
        $ip = $request->ip();
        $userAgent = $request->userAgent();
        
        // Check for suspicious user agents
        if ($this->isSuspiciousUserAgent($userAgent)) {
            Log::warning('Suspicious user agent detected', [
                'ip' => $ip,
                'user_agent' => $userAgent,
                'endpoint' => $request->path(),
            ]);
        }
        
        // Check for rapid successive requests
        $key = "requests:{$ip}:" . date('Y-m-d-H:i');
        $count = Cache::increment($key, 1);
        Cache::put($key, $count, 60); // Store with 1 minute expiration
        
        if ($count > 100) { // More than 100 requests in a minute
            Log::warning('High request rate detected', [
                'ip' => $ip,
                'count' => $count,
                'endpoint' => $request->path(),
            ]);
        }
        
        // Check for failed login attempts
        if ($request->is('login') && $request->isMethod('post')) {
            $failedKey = "failed_login:{$ip}";
            $failedCount = Cache::get($failedKey, 0);
            
            if ($failedCount >= 5) {
                Log::warning('Multiple failed login attempts', [
                    'ip' => $ip,
                    'failed_count' => $failedCount,
                    'user_agent' => $userAgent,
                ]);
            }
        }
    }

    /**
     * Check if request is rate limited
     */
    private function isRateLimited(Request $request): bool
    {
        $ip = $request->ip();
        $endpoint = $request->path();
        
        // Different rate limits for different endpoints
        $limits = [
            'login' => ['requests' => 5, 'minutes' => 15],
            'register' => ['requests' => 3, 'minutes' => 60],
            'password/reset' => ['requests' => 3, 'minutes' => 60],
            'api/' => ['requests' => 100, 'minutes' => 60],
        ];
        
        foreach ($limits as $pattern => $limit) {
            if (str_contains($endpoint, $pattern)) {
                $key = "rate_limit:{$pattern}:{$ip}";
                $current = Cache::get($key, 0);
                
                if ($current >= $limit['requests']) {
                    return true;
                }
                
                Cache::put($key, $current + 1, $limit['minutes'] * 60);
                break;
            }
        }
        
        return false;
    }

    /**
     * Check if session is compromised
     */
    private function isSessionCompromised(Request $request): bool
    {
        $user = $request->user();
        $ip = $request->ip();
        $userAgent = $request->userAgent();
        
        // Get last known IP and user agent for this user
        $lastActivity = LoginActivity::where('user_id', $user->id)
            ->where('successful', true)
            ->orderBy('created_at', 'desc')
            ->first();
        
        if ($lastActivity) {
            // Check for IP change
            if ($lastActivity->ip_address !== $ip) {
                Log::warning('IP address changed for user session', [
                    'user_id' => $user->id,
                    'old_ip' => $lastActivity->ip_address,
                    'new_ip' => $ip,
                    'user_agent' => $userAgent,
                ]);
                
                // You might want to implement additional verification here
                // For now, we'll allow it but log it
            }
            
            // Check for user agent change (could indicate session hijacking)
            if ($lastActivity->user_agent !== $userAgent) {
                Log::warning('User agent changed for user session', [
                    'user_id' => $user->id,
                    'old_user_agent' => $lastActivity->user_agent,
                    'new_user_agent' => $userAgent,
                    'ip' => $ip,
                ]);
                
                // You might want to implement additional verification here
            }
        }
        
        // Check session age
        $sessionAge = $request->session()->get('login_time', 0);
        if (time() - $sessionAge > 8 * 60 * 60) { // 8 hours
            Log::info('Session expired due to age', [
                'user_id' => $user->id,
                'session_age' => time() - $sessionAge,
            ]);
            
            return true;
        }
        
        return false;
    }

    /**
     * Check if user agent is suspicious
     */
    private function isSuspiciousUserAgent($userAgent): bool
    {
        $suspiciousPatterns = [
            'bot',
            'crawler',
            'spider',
            'scraper',
            'curl',
            'wget',
            'python',
            'java',
            'perl',
            'ruby',
            'php',
            'go-http',
            'node',
            'http-client',
        ];
        
        $lowerUserAgent = strtolower($userAgent);
        
        foreach ($suspiciousPatterns as $pattern) {
            if (str_contains($lowerUserAgent, $pattern)) {
                return true;
            }
        }
        
        // Check for empty or very short user agents
        if (empty($userAgent) || strlen($userAgent) < 10) {
            return true;
        }
        
        return false;
    }
}
