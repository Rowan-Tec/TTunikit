<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $request->validate([
            'verification_code' => ['required', 'digits:6'],
        ]);

        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return $this->logoutToLogin($request);
        }

        if (! $user->email_verification_code || ! $user->email_verification_code_expires_at) {
            throw ValidationException::withMessages([
                'verification_code' => 'Please request a new verification code.',
            ]);
        }

        if ($user->email_verification_code_expires_at->isPast()) {
            throw ValidationException::withMessages([
                'verification_code' => 'This verification code has expired. Please request a new one.',
            ]);
        }

        if (! Hash::check($request->input('verification_code'), $user->email_verification_code)) {
            throw ValidationException::withMessages([
                'verification_code' => 'The verification code is incorrect.',
            ]);
        }

        if ($user->markEmailAsVerified()) {
            $user->clearEmailVerificationCode();
            event(new Verified($user));
        }

        return $this->logoutToLogin($request);
    }

    private function logoutToLogin(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('status', 'Thank you for verifying your email, you can now login.');
    }
}
