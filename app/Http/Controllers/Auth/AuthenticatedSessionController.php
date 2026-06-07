<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

         /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->isAdmin()) {
           return redirect('/admin/dashboard');
         }

         $intendedUrl = session('url.intended', route('dashboard'));

         $message = str_contains($intendedUrl, 'wil_application')
          ? 'Welcome! Please complete your WIL application.'
          : 'Welcome to your dashboard.';

        Alert::success($message);

         //Alert::success('Login Successfully!','Welcome to your dashboard');
         
        return redirect()->intended(
        route('dashboard')
    );
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
