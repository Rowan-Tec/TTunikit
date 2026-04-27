<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $user = $request->user();

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }
            // Store new photo
            $validated['profile_photo'] = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        // Update user with validated data
        $user->fill($validated);

        // Reset email verification if email changed
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update profile information via AJAX.
     */
    public function updateProfile(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'full_names' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'alpha_dash', 'unique:users,username,' . Auth::id()],
            'cellphone' => ['required', 'string', 'max:20', 'regex:/^[+]?[0-9\s\-\(\)]+$/'],
            'gender' => ['required', 'in:male,female,non-binary,prefer-not-say'],
            'date_of_birth' => ['required', 'date', 'before:today', 'after:-120 years'],
            'billing_address' => ['nullable', 'string', 'max:500'],
        ], [
            'full_names.required' => 'Please enter your full names.',
            'surname.required' => 'Please enter your surname.',
            'username.required' => 'Please enter a username.',
            'username.alpha_dash' => 'Username may only contain letters, numbers, dashes, and underscores.',
            'username.unique' => 'This username is already taken.',
            'cellphone.required' => 'Please enter your cellphone number.',
            'cellphone.regex' => 'Please enter a valid cellphone number.',
            'gender.required' => 'Please select your gender.',
            'date_of_birth.required' => 'Please enter your date of birth.',
            'date_of_birth.before' => 'Date of birth must be before today.',
            'date_of_birth.after' => 'Date of birth cannot be more than 120 years ago.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
                'status' => 'error'
            ], 422);
        }

        $user = Auth::user();

        try {
            $user->update([
                'full_names' => $request->full_names,
                'surname' => $request->surname,
                'username' => $request->username,
                'cellphone' => $request->cellphone,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth,
                'billing_address' => $request->billing_address,
                'name' => $request->full_names . ' ' . $request->surname,
            ]);

            return response()->json([
                'message' => 'Profile updated successfully!',
                'status' => 'success',
                'user' => $user->fresh()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update profile. Please try again.',
                'error' => $e->getMessage(),
                'status' => 'error'
            ], 500);
        }
    }

    /**
     * Update email address.
     */
    public function updateEmail(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
            'password' => ['required', 'current_password'],
        ], [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already taken.',
            'password.required' => 'Please enter your password to confirm.',
            'password.current_password' => 'The password you entered is incorrect.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
                'status' => 'error'
            ], 422);
        }

        $user = Auth::user();

        try {
            $user->update([
                'email' => $request->email,
                'email_verified_at' => null, // Reset email verification
            ]);

            // Send verification email
            $user->sendEmailVerificationNotification();

            return response()->json([
                'message' => 'Email updated! Please check your inbox for verification.',
                'status' => 'success',
                'requires_verification' => true
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update email. Please try again.',
                'error' => $e->getMessage(),
                'status' => 'error'
            ], 500);
        }
    }

    /**
     * Get profile information.
     */
    public function getProfile(Request $request): JsonResponse
    {
        $user = Auth::user();

        return response()->json([
            'user' => [
                'id' => $user->id,
                'full_names' => $user->full_names,
                'surname' => $user->surname,
                'username' => $user->username,
                'email' => $user->email,
                'cellphone' => $user->cellphone,
                'gender' => $user->gender,
                'date_of_birth' => $user->date_of_birth ? $user->date_of_birth->format('Y-m-d') : null,
                'billing_address' => $user->billing_address,
                'profile_photo' => $user->profile_photo ? Storage::url($user->profile_photo) : null,
                'role' => $user->role,
                'email_verified_at' => $user->email_verified_at,
                'created_at' => $user->created_at->format('Y-m-d H:i:s'),
            ]
        ]);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Delete profile photo if exists
        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Export user data (GDPR compliance).
     */
    public function exportData(Request $request): JsonResponse
    {
        $user = Auth::user();

        $userData = [
            'personal_information' => [
                'full_names' => $user->full_names,
                'surname' => $user->surname,
                'username' => $user->username,
                'email' => $user->email,
                'cellphone' => $user->cellphone,
                'gender' => $user->gender,
                'date_of_birth' => $user->date_of_birth ? $user->date_of_birth->format('Y-m-d') : null,
                'billing_address' => $user->billing_address,
            ],
            'account_information' => [
                'role' => $user->role,
                'email_verified_at' => $user->email_verified_at,
                'created_at' => $user->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $user->updated_at->format('Y-m-d H:i:s'),
            ],
            'login_activities' => $user->loginActivities()->select([
                'login_at', 'ip_address', 'device', 'browser', 'platform', 'location', 'successful', 'activity_type'
            ])->orderBy('login_at', 'desc')->get(),
        ];

        return response()->json([
            'data' => $userData,
            'filename' => 'user-data-' . $user->username . '-' . now()->format('Y-m-d') . '.json',
        ]);
    }
}

