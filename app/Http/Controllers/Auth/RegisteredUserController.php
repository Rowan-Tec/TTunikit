<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\LoginActivity;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use App\Mail\WelcomeEmail;

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
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $request->validate([
            'full_names' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'cellphone' => ['required', 'string', 'max:20', 'regex:/^[+]?[0-9\s\-\(\)]+$/'],
            'gender' => 'required|in:male,female,non-binary,prefer-not-say',
            'date_of_birth' => ['required', 'date', 'before:today', 'after:-120 years'],
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
            'terms' => ['required', 'accepted'],
        ]);

        // Generate unique username automatically
        $username = $this->generateUniqueUsername($request->full_names, $request->surname);

        $user = User::create([
            'name' => $request->full_names . ' ' . $request->surname,
            'email' => $request->email,
            'username' => $username,
            'password' => Hash::make($request->password),
            'full_names' => $request->full_names,
            'surname' => $request->surname,
            'cellphone' => $request->cellphone,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'role' => 'customer', // Default role for new registrations
            'email_verified_at' => null, // Will be verified via email
        ]);

        // Fire registration event (this will handle email verification)
        event(new Registered($user));

        // Send welcome email
        try {
            Mail::to($user->email)->queue(new WelcomeEmail($user));
        } catch (\Exception $e) {
            Log::error('Failed to send welcome email: ' . $e->getMessage());
        }

        // Log registration activity for security
        $this->logRegistrationActivity($request, $user);

        // Don't auto-login until email is verified
        // Auth::login($user);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Registration successful! Please check your email to verify your account.',
                'redirect' => route('verification.notice'),
                'requires_verification' => true,
            ]);
        }

        return redirect()->route('verification.notice')
            ->with('status', 'Registration successful! Please check your email to verify your account.');
    }

    /**
     * Generate a unique username from full names
     */
    private function generateUniqueUsername($firstName, $lastName): string
    {
        $baseUsername = Str::lower(Str::slug($firstName . ' ' . $lastName));
        $username = $baseUsername;
        $counter = 1;

        while (User::where('username', $username)->exists()) {
            $username = $baseUsername . $counter;
            $counter++;
        }

        return $username;
    }

    /**
     * Log registration activity for security tracking
     */
    private function logRegistrationActivity(Request $request, User $user): void
    {
        try {
            // Create a login activity record for registration
            \App\Models\LoginActivity::create([
                'user_id' => $user->id,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'device' => $this->getDeviceInfo($request->userAgent()),
                'browser' => $this->getBrowserInfo($request->userAgent()),
                'platform' => $this->getPlatformInfo($request->userAgent()),
                'location' => $this->getLocationFromIp($request->ip()),
                'login_at' => now(),
                'successful' => true,
                'activity_type' => 'registration',
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to log registration activity: ' . $e->getMessage());
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
