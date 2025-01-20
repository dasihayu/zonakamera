@extends('layouts.layout')

@section('title', 'Product')

@section('content')
    <section class="container px-4 py-12 mx-auto">
        <h1 class="mb-8 text-4xl font-bold text-center">Our Products</h1>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <div class="p-6 bg-white rounded-lg shadow-md">
                <h3 class="mb-4 text-xl font-bold">Product One</h3>
                <p class="text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-md">
                <h3 class="mb-4 text-xl font-bold">Product Two</h3>
                <p class="text-gray-700">Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-md">
                <h3 class="mb-4 text-xl font-bold">Product Three</h3>
                <p class="text-gray-700">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
            </div>
        </div>
    </section>
@endsection
