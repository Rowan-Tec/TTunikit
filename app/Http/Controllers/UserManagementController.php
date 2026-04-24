<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserManagementController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index(): View
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for editing user role.
     */
    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the user role.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'role' => 'required|in:customer,user,admin,super_admin,moderator',
        ]);

        $user->update([
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User role updated successfully.');
    }
}
