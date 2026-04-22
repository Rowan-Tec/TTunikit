<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class Pages extends Controller
{
    public function index(Request $request, string $slug)
    {
        // Optional: protect system routes
        if (in_array($slug, ['login', 'register', 'admin', 'api'])) {
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