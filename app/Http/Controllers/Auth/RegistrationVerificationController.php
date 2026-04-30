<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PendingRegistration;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\Verified;

class RegistrationVerificationController extends Controller
{
    /**
     * Handle the verification of pending registration
     */
    public function verify(Request $request, string $token): RedirectResponse
    {
        // Find the pending registration
        $pendingRegistration = PendingRegistration::where('token', $token)->first();

        if (!$pendingRegistration) {
            return redirect()->route('register')
                ->with('error', 'Invalid verification link. Please register again.');
        }

        if ($pendingRegistration->isExpired()) {
            $pendingRegistration->delete();
            return redirect()->route('register')
                ->with('error', 'Verification link has expired. Please register again.');
        }

        try {
            // Create the actual user account
            $user = User::create([
                'name' => $pendingRegistration->full_names . ' ' . $pendingRegistration->surname,
                'email' => $pendingRegistration->email,
                'username' => $pendingRegistration->username,
                'password' => $pendingRegistration->password, // Already hashed
                'full_names' => $pendingRegistration->full_names,
                'surname' => $pendingRegistration->surname,
                'cellphone' => $pendingRegistration->cellphone,
                'gender' => $pendingRegistration->gender,
                'date_of_birth' => $pendingRegistration->date_of_birth,
                'email_verified_at' => now(), // Mark as verified immediately
            ]);

            // Delete the pending registration
            $pendingRegistration->delete();

            // Fire the verified event
            event(new Verified($user));

            Log::info('User successfully verified and created: ' . $user->email);

            return redirect()->route('login')
                ->with('success', 'Your account has been successfully created! You can now login with your credentials.');

        } catch (\Exception $e) {
            Log::error('Failed to create user from pending registration: ' . $e->getMessage());
            
            return redirect()->route('register')
                ->with('error', 'An error occurred while creating your account. Please try registering again.');
        }
    }
}
