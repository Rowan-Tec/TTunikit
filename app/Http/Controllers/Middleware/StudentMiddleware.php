<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        /** @var \App\Models\User $user */
          $user = Auth::user();

     if (!Auth::check() || !$user->isStudent()) {
            abort(403, 'Access denied.');
        }

        return $next($request);
    }
}