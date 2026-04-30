<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Mail\LoginNotificationEmail;
use App\Models\LoginActivity;
use Illuminate\Support\Facades\Mail;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse|JsonResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        // Log login activity
        $loginActivity = $this->logLoginActivity($request, $user);

        // Fire login event to trigger listeners (for login activity logging and notifications)
        event(new Login('web', $user, true));

        // Send login notification email
        try {
            Mail::to($user->email)->queue(new LoginNotificationEmail($user, $loginActivity));
        } catch (\Exception $e) {
            // Log without exposing email or error details
            \Log::error('Login notification failed at ' . now()->format('Y-m-d H:i:s'));
            // Continue with login - email failure shouldn't block user
        }

        // Return JSON if requested via AJAX
        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Login successful',
                'redirect' => route('dashboard', absolute: false)
            ]);
        }

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Log login activity for security tracking
     */
    private function logLoginActivity(Request $request, $user): LoginActivity
    {
        $ipAddress = $request->ip();
        $userAgent = $request->userAgent();
        
        // Get location information (you may want to use a service like GeoIP)
        $location = $this->getLocationFromIp($ipAddress);
        
        // Basic device detection from user agent
        $device = $this->getDeviceInfo($userAgent);
        $browser = $this->getBrowserInfo($userAgent);
        $platform = $this->getPlatformInfo($userAgent);

        return LoginActivity::create([
            'user_id' => $user->id,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'device' => $device,
            'browser' => $browser,
            'platform' => $platform,
            'location' => $location,
            'login_at' => now(),
            'successful' => true,
        ]);
    }

    /**
     * Get basic device information from user agent
     */
    private function getDeviceInfo($userAgent): string
    {
        if (preg_match('/Mobile|Android|iPhone|iPad|iPod/', $userAgent)) {
            return 'Mobile Device';
        } elseif (preg_match('/Tablet/', $userAgent)) {
            return 'Tablet';
        } else {
            return 'Desktop';
        }
    }

    /**
     * Get basic browser information from user agent
     */
    private function getBrowserInfo($userAgent): string
    {
        if (preg_match('/Chrome/', $userAgent)) {
            return 'Chrome';
        } elseif (preg_match('/Firefox/', $userAgent)) {
            return 'Firefox';
        } elseif (preg_match('/Safari/', $userAgent)) {
            return 'Safari';
        } elseif (preg_match('/Edge/', $userAgent)) {
            return 'Edge';
        } else {
            return 'Unknown Browser';
        }
    }

    /**
     * Get basic platform information from user agent
     */
    private function getPlatformInfo($userAgent): string
    {
        if (preg_match('/Windows/', $userAgent)) {
            return 'Windows';
        } elseif (preg_match('/Mac/', $userAgent)) {
            return 'macOS';
        } elseif (preg_match('/Linux/', $userAgent)) {
            return 'Linux';
        } elseif (preg_match('/Android/', $userAgent)) {
            return 'Android';
        } elseif (preg_match('/iOS|iPhone|iPad/', $userAgent)) {
            return 'iOS';
        } else {
            return 'Unknown Platform';
        }
    }

    /**
     * Get location from IP address (basic implementation)
     * You may want to integrate with a GeoIP service for more accurate data
     */
    private function getLocationFromIp($ip): string
    {
        // For now, return a basic location
        // In production, you'd want to use a service like:
        // - GeoIP2
        // - ipstack
        // - ipinfo.io
        // - MaxMind GeoLite2
        
        if ($ip === '127.0.0.1' || $ip === '::1') {
            return 'Localhost';
        }
        
        // Simple fallback - you can enhance this
        return 'Unknown Location';
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = Auth::user();
        
        // Log logout activity if user is authenticated
        if ($user) {
            try {
                LoginActivity::create([
                    'user_id' => $user->id,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'login_at' => now(),
                    'successful' => false,
                    'logout_at' => now(),
                    'activity_type' => 'logout',
                ]);
            } catch (\Exception $e) {
                \Log::error('Failed to log logout activity: ' . $e->getMessage());
            }
        }

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
