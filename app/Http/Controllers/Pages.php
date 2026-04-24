<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class Pages extends Controller
{
    public function index(Request $request, string $slug)
    {
        // Normalize URL slugs such as auth-login-cover.html to auth-login-cover
        if (str_ends_with($slug, '.html')) {
            $slug = substr($slug, 0, -5);
        }

        // Optional: protect system routes
        if (in_array($slug, ['admin', 'api'])) {
            abort(404);
        }

        // Page config
        $pageConfigs = [
            'view'      => $slug,
            'pageClass' => $slug . '-page',
            'bodyClass' => $slug . '-page',
        ];

        // Page must exist: resources/views/pages/{slug}.blade.php
        if (!View::exists('pages.' . $slug)) {
            abort(404);
        }

        return view('pages', compact('pageConfigs'));
    }
}