@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:text-blue-900">&larr; Back to Users</a>
            <h1 class="text-3xl font-bold text-gray-900 mt-2">Edit User: {{ $user->name }}</h1>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="mb-6 pb-6 border-b">
                <h2 class="text-lg font-semibold text-gray-900">User Information</h2>
                <dl class="mt-4 space-y-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Full Name</dt>
                        <dd class="text-sm text-gray-900 mt-1">{{ $user->full_names ?? 'N/A' }} {{ $user->surname ?? '' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                        <dd class="text-sm text-gray-900 mt-1">{{ $user->email }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Phone</dt>
                        <dd class="text-sm text-gray-900 mt-1">{{ $user->cellphone ?? 'N/A' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Member Since</dt>
                        <dd class="text-sm text-gray-900 mt-1">{{ $user->created_at->format('F d, Y') }}</dd>
                    </div>
                </dl>
            </div>

            <form method="POST" action="{{ route('admin.users.update-role', $user) }}">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label for="role" class="block text-sm font-medium text-gray-900">User Role</label>
                    <select id="role" name="role" class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="customer" @if($user->role === 'customer') selected @endif>
                            Customer (Default User)
                        </option>
                        <option value="admin" @if($user->role === 'admin') selected @endif>
                            Admin (Can manage other users)
                        </option>
                        <option value="super_admin" @if($user->role === 'super_admin') selected @endif>
                            Super Admin (Full access)
                        </option>
                    </select>
                    @error('role')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <p class="text-sm text-gray-600">
                        Current role: <span class="font-semibold">{{ ucfirst(str_replace('_', ' ', $user->role)) }}</span>
                    </p>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Update Role
                    </button>
                </div>
            </form>

            @if (session('success'))
                <div class="mt-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
