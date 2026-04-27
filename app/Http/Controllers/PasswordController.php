<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password as PasswordRules;
use App\Mail\PasswordChangedEmail;
use App\Models\LoginActivity;
use App\Services\TokenService;

class PasswordController extends Controller
{
    /**
     * Display the password change form.
     */
    public function showChangeForm()
    {
        return view('profile.change-password');
    }

    /**
     * Handle password change request.
     */
    public function change(Request $request): JsonResponse
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', PasswordRules::defaults()],
        ], [
            'current_password.required' => 'Please enter your current password.',
            'current_password.current_password' => 'The current password is incorrect.',
            'password.required' => 'Please enter a new password.',
            'password.confirmed' => 'The password confirmation does not match.',
        ]);

        $user = Auth::user();

        try {
            // Update password
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            // Log password change activity
            $loginActivity = $this->logPasswordChange($request, $user);

            // Send password change notification email
            try {
                Mail::to($user->email)->queue(new PasswordChangedEmail($user, $loginActivity));
            } catch (\Exception $e) {
                Log::error('Failed to send password change notification: ' . $e->getMessage());
            }

            // Revoke all existing tokens for this user (security measure)
            TokenService::revokeAllUserTokens($user->id);

            // Regenerate session for security
            $request->session()->regenerate();
            $request->session()->put('login_time', time());

            return response()->json([
                'message' => 'Password changed successfully!',
                'status' => 'success'
            ]);

        } catch (\Exception $e) {
            Log::error('Password change failed: ' . $e->getMessage());
            
            return response()->json([
                'message' => 'Failed to change password. Please try again.',
                'status' => 'error'
            ], 500);
        }
    }

    /**
     * Handle password change via API.
     */
    public function changeApi(Request $request): JsonResponse
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', PasswordRules::defaults()],
        ]);

        $user = $request->user();

        // Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => 'Current password is incorrect.',
                'status' => 'error'
            ], 422);
        }

        try {
            // Update password
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            // Log password change activity
            $this->logPasswordChange($request, $user);

            // Send password change notification email
            try {
                Mail::to($user->email)->queue(new PasswordChangedEmail($user, null));
            } catch (\Exception $e) {
                Log::error('Failed to send password change notification: ' . $e->getMessage());
            }

            // Revoke all existing tokens for this user
            TokenService::revokeAllUserTokens($user->id);

            return response()->json([
                'message' => 'Password changed successfully!',
                'status' => 'success'
            ]);

        } catch (\Exception $e) {
            Log::error('API password change failed: ' . $e->getMessage());
            
            return response()->json([
                'message' => 'Failed to change password. Please try again.',
                'status' => 'error'
            ], 500);
        }
    }

    /**
     * Log password change activity for security tracking
     */
    private function logPasswordChange(Request $request, $user): LoginActivity
    {
        try {
            return LoginActivity::create([
                'user_id' => $user->id,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'device' => $this->getDeviceInfo($request->userAgent()),
                'browser' => $this->getBrowserInfo($request->userAgent()),
                'platform' => $this->getPlatformInfo($request->userAgent()),
                'location' => $this->getLocationFromIp($request->ip()),
                'login_at' => now(),
                'successful' => true,
                'activity_type' => 'password_changed',
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to log password change activity: ' . $e->getMessage());
            return null;
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
