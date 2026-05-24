<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'referral' => ['required', 'in:with,without'],
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'contact_number' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',

            // Required only when the user chooses to register with a referral code.
            'ref_code' => ['required_if:referral,with', 'nullable', 'string', 'max:255', 'exists:users,reference_code'],

            // These fields are used in the UI/form
            'gender' => ['required', 'string', 'max:255'],
            'province' => ['required'],
            'dob_day' => ['required', 'integer', 'min:1', 'max:31'],
            'dob_month' => ['required', 'integer', 'min:1', 'max:12'],
            'dob_year' => ['required', 'integer', 'min:1900', 'max:'.date('Y')],

            'terms' => ['accepted'],

        ], [
            'terms.accepted' => 'You must agree to the privacy policy and terms.',
            'password_confirmation.same' => 'The password confirmation does not match.',
        ]);

        if (! checkdate((int) $validated['dob_month'], (int) $validated['dob_day'], (int) $validated['dob_year'])) {
            throw ValidationException::withMessages([
                'dob_day' => ['Please enter a valid date of birth.'],
            ]);
        }

        $dateOfBirth = sprintf(
            '%04d-%02d-%02d',
            $validated['dob_year'],
            $validated['dob_month'],
            $validated['dob_day']
        );

        $user = DB::transaction(function () use ($validated, $dateOfBirth) {
            $referrer = null;

            if ($validated['referral'] === 'with') {
                $referrer = User::where('reference_code', $validated['ref_code'])->lockForUpdate()->first();
            }

            $user = User::create([
                'name' => $validated['first_name'],

                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'contact_number' => $validated['contact_number'],
                'gender' => $validated['gender'],
                'province' => $validated['province'],
                'reference_code' => null,
                'date_of_birth' => $dateOfBirth,

                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            $user->forceFill([
                'reference_code' => $this->generateReferenceCode($user->id),
            ])->save();

            if ($referrer) {
                $referrer->increment('points', 10);
            }

            return $user;
        });


        event(new Registered($user));

        Auth::login($user);

        // If email verification is required, block access to dashboard until verified
        if (! $user->hasVerifiedEmail()) {
            return redirect()->route('verification.notice');
        }

        return redirect(route('dashboard', absolute: false));
    }

    private function generateReferenceCode(int $userId): string
    {
        return 'TTUNIK'.str_pad((string) $userId, 5, '0', STR_PAD_LEFT);
    }
}
