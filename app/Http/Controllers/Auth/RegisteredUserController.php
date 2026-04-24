<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
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
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $request->validate([
            'full_names' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'cellphone' => ['required', 'string', 'max:20'],
            'gender' => 'required|in:male,female,non-binary,prefer-not-say',
            'date_of_birth' => ['required', 'date'],
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
            'terms' => ['required', 'accepted'],
        ]);

        $user = User::create([
            'name' => $request->full_names . ' ' . $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'full_names' => $request->full_names,
            'surname' => $request->surname,
            'cellphone' => $request->cellphone,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'role' => 'customer', // Default role for new registrations
        ]);

        event(new Registered($user));

        Auth::login($user);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Registration successful',
                'redirect' => route('dashboard', absolute: false),
            ]);
        }

        return redirect(route('dashboard', absolute: false));
    }
}
