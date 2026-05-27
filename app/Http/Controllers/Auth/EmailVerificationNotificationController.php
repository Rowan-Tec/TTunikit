<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\EmailVerificationCode;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        $availableAt = (int) $request->session()->get('verification_resend_available_at', 0);

        if ($availableAt > now()->timestamp) {
            return back()->with('status', 'verification-link-wait');
        }

        $verificationCode = $request->user()->generateEmailVerificationCode();
        $request->user()->notify(new EmailVerificationCode($verificationCode));
        $request->session()->put('verification_resend_available_at', now()->addMinutes(3)->timestamp);

        return back()->with('status', 'verification-code-sent');
    }
}
