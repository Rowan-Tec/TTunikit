<?php

namespace App\Http\Controllers;

use App\Models\CallRequest;
use Illuminate\Http\Request;

class CallRequestController extends Controller
{
    // Store a new call request (public)
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        CallRequest::create([
            'name'  => $request->name,
            'phone' => $request->phone,
        ]);

        return back()->with('success', 'We will call you back shortly!');
    }

    // Mark as completed (admin)
    public function complete($id)
    {
        $callRequest = CallRequest::findOrFail($id);
        $callRequest->update(['status' => 'completed']);

        return back()->with('success', 'Marked as completed.');
    }

    // Delete (admin)
    public function destroy($id)
    {
        CallRequest::findOrFail($id)->delete();

        return back()->with('success', 'Call request deleted.');
    }
}