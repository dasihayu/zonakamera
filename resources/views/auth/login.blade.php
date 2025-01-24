@extends('layouts.auth')
@section('title', 'Login')

@section('content')
<h2 class="text-2xl lg:text-3xl font-bold text-center text-primary mb-8">Login</h2>
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="mb-6">
        <label for="email" class="block text-sm lg:text-base font-medium text-gray-700">Email</label>
        <input id="email" type="email" class="w-full mt-2 p-3 border border-gray-300 rounded-md focus:ring-primary focus:border-primary" name="email" value="{{ old('email') }}" required autofocus>
        @error('email')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-6">
        <label for="password" class="block text-sm lg:text-base font-medium text-gray-700">Password</label>
        <input id="password" type="password" class="w-full mt-2 p-3 border border-gray-300 rounded-md focus:ring-primary focus:border-primary" name="password" required>
        @error('password')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div class="flex items-center justify-between">
        <button type="submit" class="w-full bg-primary text-white py-3 rounded-md hover:bg-primary-light focus:outline-none focus:ring-2 focus:ring-primary">
            Login
        </button>
    </div>
</form>
<div class="flex justify-between items-center mt-6">
    <p>Don't have an account? <a href="{{ route('register') }}" class="text-primary hover:text-primary-light">Register</a></p>
</div>
@endsection
