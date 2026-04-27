<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountDeletionConfirmationEmail;
use App\Models\LoginActivity;
use App\Services\TokenService;

class AccountDeletionController extends Controller
{
    /**
     * Display the account deletion confirmation page.
     */
    public function showDeletionForm()
    {
        return view('profile.delete-account');
    }

    /**
     * Handle account deletion request.
     */
    public function delete(Request $request): JsonResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
            'confirmation' => ['required', 'accepted'],
            'reason' => ['nullable', 'string', 'max:500'],
        ], [
            'password.required' => 'Please enter your password to confirm deletion.',
            'password.current_password' => 'The password you entered is incorrect.',
            'confirmation.required' => 'You must confirm that you want to delete your account.',
            'confirmation.accepted' => 'You must confirm that you want to delete your account.',
        ]);

        $user = Auth::user();

        try {
            DB::beginTransaction();

            // Log the deletion request
            $this->logAccountDeletion($request, $user);

            // Send confirmation email before deletion
            try {
                Mail::to($user->email)->queue(new AccountDeletionConfirmationEmail($user, $request->reason));
            } catch (\Exception $e) {
                Log::error('Failed to send account deletion confirmation email: ' . $e->getMessage());
            }

            // Delete user's login activities
            LoginActivity::where('user_id', $user->id)->delete();

            // Revoke all tokens for this user
            TokenService::revokeAllUserTokens($user->id);

            // Delete the user account
            $user->delete();

            DB::commit();

            // Log out the user
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return response()->json([
                'message' => 'Your account has been successfully deleted. You will be redirected to the home page.',
                'status' => 'success',
                'redirect' => route('login')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Account deletion failed: ' . $e->getMessage());

            return response()->json([
                'message' => 'Failed to delete your account. Please try again or contact support.',
                'status' => 'error'
            ], 500);
        }
    }

    /**
     * Handle account deletion request via API.
     */
    public function deleteApi(Request $request): JsonResponse
    {
        $request->validate([
            'password' => ['required'],
            'confirmation' => ['required', 'accepted'],
            'reason' => ['nullable', 'string', 'max:500'],
        ]);

        $user = $request->user();

        // Verify password
        if (!\Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'The password you entered is incorrect.',
                'status' => 'error'
            ], 422);
        }

        try {
            DB::beginTransaction();

            // Log the deletion request
            $this->logAccountDeletion($request, $user);

            // Send confirmation email before deletion
            try {
                Mail::to($user->email)->queue(new AccountDeletionConfirmationEmail($user, $request->reason));
            } catch (\Exception $e) {
                Log::error('Failed to send account deletion confirmation email: ' . $e->getMessage());
            }

            // Delete user's login activities
            LoginActivity::where('user_id', $user->id)->delete();

            // Revoke all tokens for this user
            TokenService::revokeAllUserTokens($user->id);

            // Delete the user account
            $user->delete();

            DB::commit();

            return response()->json([
                'message' => 'Your account has been successfully deleted.',
                'status' => 'success'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('API account deletion failed: ' . $e->getMessage());

            return response()->json([
                'message' => 'Failed to delete your account. Please try again or contact support.',
                'status' => 'error'
            ], 500);
        }
    }

    /**
     * Request account deletion (soft delete for review period).
     */
    public function requestDeletion(Request $request): JsonResponse
    {
        $request->validate([
            'reason' => ['required', 'string', 'max:500'],
            'confirmation' => ['required', 'accepted'],
        ], [
            'reason.required' => 'Please provide a reason for account deletion.',
            'confirmation.required' => 'You must confirm that you want to delete your account.',
        ]);

        $user = Auth::user();

        try {
            // Mark account for deletion (soft delete)
            $user->update([
                'account_deletion_requested_at' => now(),
                'account_deletion_reason' => $request->reason,
                'account_deletion_token' => bin2hex(random_bytes(32)),
            ]);

            // Send confirmation email with cancellation link
            try {
                Mail::to($user->email)->queue(new AccountDeletionConfirmationEmail($user, $request->reason));
            } catch (\Exception $e) {
                Log::error('Failed to send account deletion request email: ' . $e->getMessage());
            }

            return response()->json([
                'message' => 'Account deletion request submitted. You will receive a confirmation email with details.',
                'status' => 'success'
            ]);

        } catch (\Exception $e) {
            Log::error('Account deletion request failed: ' . $e->getMessage());

            return response()->json([
                'message' => 'Failed to submit deletion request. Please try again.',
                'status' => 'error'
            ], 500);
        }
    }

    /**
     * Cancel account deletion request.
     */
    public function cancelDeletion(Request $request): JsonResponse
    {
        $user = Auth::user();

        try {
            $user->update([
                'account_deletion_requested_at' => null,
                'account_deletion_reason' => null,
                'account_deletion_token' => null,
            ]);

            return response()->json([
                'message' => 'Account deletion request cancelled successfully.',
                'status' => 'success'
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to cancel account deletion: ' . $e->getMessage());

            return response()->json([
                'message' => 'Failed to cancel deletion request. Please try again.',
                'status' => 'error'
            ], 500);
        }
    }

    /**
     * Log account deletion for security tracking
     */
    private function logAccountDeletion(Request $request, $user): void
    {
        try {
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
                'activity_type' => 'account_deleted',
                'notes' => 'Reason: ' . ($request->reason ?? 'Not provided'),
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to log account deletion: ' . $e->getMessage());
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
