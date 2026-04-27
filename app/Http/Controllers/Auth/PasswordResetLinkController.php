<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use App\Mail\PasswordResetEmail;
use App\Models\LoginActivity;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ], [
            'email.exists' => 'We cannot find a user with that email address.',
        ]);

        // Log password reset request for security
        $this->logPasswordResetRequest($request);

        // Use custom password reset notification
        $user = User::where('email', $request->email)->first();
        
        if ($user) {
            try {
                // Generate token manually to use our custom email
                $token = Password::createToken($user);
                
                // Send custom password reset email
                Mail::to($user->email)->queue(new PasswordResetEmail($user, $token));
                
                // Log successful password reset email sent
                Log::info('Password reset email sent', [
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'ip' => $request->ip(),
                ]);
                
            } catch (\Exception $e) {
                Log::error('Failed to send password reset email: ' . $e->getMessage());
                
                // Fallback to Laravel's default system
                $status = Password::sendResetLink($request->only('email'));
                
                if ($request->wantsJson()) {
                    return response()->json([
                        'message' => $status == Password::RESET_LINK_SENT ? 'Password reset link sent!' : 'Failed to send reset link.',
                        'status' => $status,
                    ], $status == Password::RESET_LINK_SENT ? 200 : 400);
                }
                
                return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($status)]);
            }
        }

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Password reset link sent! Please check your email.',
                'status' => 'sent',
            ]);
        }

        return back()
            ->with('status', 'Password reset link sent! Please check your email.')
            ->withInput($request->only('email'));
    }

    /**
     * Log password reset request for security tracking
     */
    private function logPasswordResetRequest(Request $request): void
    {
        try {
            $user = User::where('email', $request->email)->first();
            
            if ($user) {
                LoginActivity::create([
                    'user_id' => $user->id,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'device' => $this->getDeviceInfo($request->userAgent()),
                    'browser' => $this->getBrowserInfo($request->userAgent()),
                    'platform' => $this->getPlatformInfo($request->userAgent()),
                    'location' => $this->getLocationFromIp($request->ip()),
                    'login_at' => now(),
                    'successful' => true,
                    'activity_type' => 'password_reset_request',
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Failed to log password reset request: ' . $e->getMessage());
        }
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
     */
    private function getLocationFromIp($ip): string
    {
        if ($ip === '127.0.0.1' || $ip === '::1') {
            return 'Localhost';
        }
        
        return 'Unknown Location';
    }
}
