<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PendingRegistration;
use App\Models\LoginActivity;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
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
use App\Mail\VerifyRegistrationEmail;

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
     * Sanitize input data to prevent XSS and injection attacks
     */
    private function sanitizeInput(array $input): array
    {
        return [
            'full_names' => strip_tags(trim($input['full_names'])),
            'surname' => strip_tags(trim($input['surname'])),
            'email' => strtolower(filter_var($input['email'], FILTER_SANITIZE_EMAIL)),
            'cellphone' => preg_replace('/[^0-9+\-()\s]/', '', $input['cellphone']),
            'gender' => $input['gender'],
            'date_of_birth' => $input['date_of_birth'],
            'terms' => $input['terms'] ?? false,
        ];
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse|\Illuminate\Http\JsonResponse
    {
        $request->validate([
            'full_names' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class, 'unique:pending_registrations'],
            'cellphone' => ['required', 'string', 'max:20', 'regex:/^[+]?[0-9\s\-\(\)]+$/'],
            'gender' => 'required|in:male,female,non-binary,prefer-not-say',
            'date_of_birth' => ['required', 'string', 'date_format:Y-m-d'],
            'password' => [
                'required',
                'string',
                'min:12',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
                \Illuminate\Validation\Rules\Password::defaults(),
            ],
            'terms' => ['required', 'accepted'],
        ], [
            'password.regex' => 'Password must contain at least one lowercase letter, one uppercase letter, one number, and one special character (@$!%*#?&)',
            'password.min' => 'Password must be at least 12 characters long',
        ]);

        try {
            // Clean up expired registrations first
            PendingRegistration::cleanupExpired();

            // Sanitize input data
            $sanitizedData = $this->sanitizeInput($request->all());

            // Generate unique username automatically
            $username = $this->generateUniqueUsername($sanitizedData['full_names'], $sanitizedData['surname']);

            // Create pending registration (NOT in users table)
            $pendingRegistration = PendingRegistration::createPending([
                'full_names' => $sanitizedData['full_names'],
                'surname' => $sanitizedData['surname'],
                'email' => $sanitizedData['email'],
                'username' => $username,
                'password' => Hash::make($request->password), // Never sanitize password
                'cellphone' => $sanitizedData['cellphone'],
                'gender' => $sanitizedData['gender'],
                'date_of_birth' => $sanitizedData['date_of_birth'],
            ]);

        } catch (\Exception $e) {
            // Log error without exposing sensitive data
            Log::error('Registration failed at ' . now()->format('Y-m-d H:i:s'));
            
            // Generic error message - no data leakage
            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'Registration temporarily unavailable. Please try again later.',
                    'status' => 'error',
                ], 500);
            }
            
            return redirect()->route('register')
                ->with('error', 'Registration temporarily unavailable. Please try again later.');
        }

        // Send verification email with token
        try {
            Mail::to($request->email)->queue(new VerifyRegistrationEmail($pendingRegistration));
        } catch (\Exception $e) {
            // Log without exposing email or error details
            Log::error('Email notification failed at ' . now()->format('Y-m-d H:i:s'));
            // Continue with registration - email failure shouldn't block user
        }

        // Don't auto-login until email is verified
        // User data is stored in pending_registrations table until verification

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Registration successful! Please check your email to verify your account.',
                'redirect' => route('verification.verification.notice'),
                'requires_verification' => true,
            ]);
        }

        return redirect()->route('verification.verification.notice')
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

        while (User::where('username', $username)->exists() || PendingRegistration::where('username', $username)->exists()) {
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
