@extends('layouts.layout')

@section('title', 'Change Password')

@section('content')
    <div class="min-h-screen py-12 bg-gray-100">
        <div class="max-w-md px-6 mx-auto">
            <div class="p-8 bg-white rounded-lg shadow-md">
                <h2 class="mb-6 text-2xl font-bold text-center text-gray-900">Change Password</h2>

                @if (session('status'))
                    <div class="p-4 mb-6 text-sm text-green-700 bg-green-100 rounded-lg">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <div class="mb-6">
                        <label for="current_password" class="block mb-2 text-sm font-medium text-gray-700">
                            Current Password
                        </label>
                        <input type="password" name="current_password" id="current_password"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary @error('current_password') border-red-500 @enderror"
                            required>
                        @error('current_password')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="new_password" class="block mb-2 text-sm font-medium text-gray-700">
                            New Password
                        </label>
                        <input type="password" name="new_password" id="new_password"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary @error('new_password') border-red-500 @enderror"
                            required>
                        @error('new_password')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="new_password_confirmation" class="block mb-2 text-sm font-medium text-gray-700">
                            Confirm New Password
                        </label>
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary"
                            required>
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit"
                            class="w-full px-4 py-2 text-white rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            Change Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
