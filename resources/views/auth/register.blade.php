@extends('layouts.auth')
@section('title', 'Register')

@section('content')
    <h2 class="text-2xl lg:text-3xl font-bold text-center text-primary mb-8">Register</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <!-- First Name and Last Name -->
        <div class="flex flex-row w-full gap-2">
            <div class="mb-6 w-full">
                <label for="firstName" class="block text-sm lg:text-base font-medium text-gray-700">First Name</label>
                <input id="firstName" type="text" placeholder="Jhon"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                    name="firstName" value="{{ old('firstName') }}" required autofocus>
                @error('firstName')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-6 w-full">
                <label for="lastName" class="block text-sm lg:text-base font-medium text-gray-700">Last Name</label>
                <input id="lastName" type="text" placeholder="Doe"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                    name="lastName" value="{{ old('lastName') }}" required>
                @error('lastName')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <!-- Email -->
        <div class="mb-6">
            <label for="email" class="block text-sm lg:text-base font-medium text-gray-700">Email</label>
            <input id="email" type="email" placeholder="d6oOu@example.com"
                class="w-full mt-2 p-3 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                name="email" value="{{ old('email') }}" required>
            @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <!-- Phone -->
        <div class="mb-6">
            <label for="phone" class="block text-sm lg:text-base font-medium text-gray-700">Phone</label>
            <input id="phone" type="text" placeholder="08123456789"
                class="w-full mt-2 p-3 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                name="phone" value="{{ old('phone') }}" required>
            @error('phone')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <!-- Password -->
        <div class="mb-6">
            <label for="password" class="block text-sm lg:text-base font-medium text-gray-700">Password</label>
            <input id="password" type="password"
                class="w-full mt-2 p-3 border border-gray-300 rounded-md focus:ring-primary focus:border-primary pr-12"
                name="password" required>
            @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <!-- Confirm Password -->
        <div class="mb-6">
            <label for="password_confirmation" class="block text-sm lg:text-base font-medium text-gray-700">Confirm
                Password</label>
            <input id="password_confirmation" type="password"
                class="w-full mt-2 p-3 border border-gray-300 rounded-md focus:ring-primary focus:border-primary pr-12"
                name="password_confirmation" required>
        </div>
        <!-- Submit Button -->
        <div class="flex items-center justify-between">
            <button type="submit"
                class="w-full bg-primary text-white py-3 rounded-md hover:bg-primary-light focus:outline-none focus:ring-2 focus:ring-primary">
                Register
            </button>
        </div>
    </form>
    <div class="flex justify-between items-center mt-6">
        <p>Already have an account? <a href="{{ route('login') }}" class="text-primary hover:text-primary-light">Login</a>
        </p>
    </div>
@endsection
