@extends('layouts.auth')
@section('title', 'Login')

@section('content')
<h2 class="mb-6 text-2xl font-bold text-center md:text-3xl text-primary">Login</h2>
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700 md:text-base">Email</label>
        <input id="email" type="email" class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary" name="email" value="{{ old('email') }}" required autofocus>
        @error('email')
            <span class="text-xs text-red-500">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-700 md:text-base">Password</label>
        <input id="password" type="password" class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary" name="password" required>
        @error('password')
            <span class="text-xs text-red-500">{{ $message }}</span>
        @enderror
    </div>
    <button type="submit" class="w-full py-3 text-white transition rounded-md bg-primary hover:bg-primary-light focus:outline-none focus:ring-2 focus:ring-primary">
        Login
    </button>
</form>
<div class="mt-6 text-center">
    <p class="text-sm">Don't have an account? <a href="{{ route('register') }}" class="font-medium text-primary hover:text-primary-light">Register</a></p>
</div>
@endsection
