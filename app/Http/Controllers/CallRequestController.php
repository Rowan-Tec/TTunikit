<?php

namespace App\Http\Controllers;

use App\Models\CallRequest;
use Illuminate\Http\Request;


class CallRequestController extends Controller
{
    // Store a new call request (called from landing page)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'phone_number' => ['required', 'string', 'min:9', 'max:15'],
        ]);

        CallRequest::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Thank you! We will call you shortly.',
        ], 201);
    }

    // List all call requests (admin dashboard)
    public function index()
    {
        $callRequests = CallRequest::latest()->paginate(20);

        return view('admin.call-requests.index', compact('callRequests'));
    }

    // Mark a request as called
    public function markAsCalled(CallRequest $callRequest)
    {
        $callRequest->update([
            'status'    => 'called',
            'called_at' => now(),
        ]);

        return back()->with('success', 'Marked as called!');
    }

}
