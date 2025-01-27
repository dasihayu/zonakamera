@extends('layouts.layout')

@section('title', 'About Us')

@section('content')
    <!-- Hero Section -->
    <div class="relative">
        <!-- Background Image -->
        <img src="{{ asset('storage/' . $page->about_banner) }}" alt="Hero Image"
            class="object-cover w-full max-h-80 blur-sm" />
        <!-- Headline -->
        <div class="absolute inset-0 flex flex-col items-center justify-center mt-16 text-center">
            <h1 class="text-6xl font-extrabold text-white md:text-8xl drop-shadow-lg">
                @yield('title')
            </h1>
        </div>
    </div>
    <!-- About Section -->
    <div class="flex flex-row items-center py-6 pr-6 my-24 text-center justify-evenly">
        <img src="{{ asset('storage/' . $page->about_image) }}" width="600" alt="" class="rounded-xl">
        <div class="flex flex-col w-[500px] gap-2">
            <p class="text-left text-primary">ABOUT US</p>
            <h1 class="text-5xl font-bold text-left">{{ $page->about_content_title }}</h1>
            <p class="text-left">{{ $page->about_content_desctiption }}</p>
        </div>
    </div>

    <div class="flex flex-row items-center py-6 pr-6 my-24 text-center justify-evenly">
        <div class="flex flex-col w-[500px] gap-2">
            <h1 class="text-5xl font-bold text-left">{{ $page->about_map_title }}</h1>
            <p class="text-left">{{ $page->about_map_text }}</p>
        </div>
        <div id="map" class="w-full max-w-screen-sm h-80 rounded-xl"></div>
    </div>

@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const map = L.map('map').setView([-6.98312305112442, 110.46219552383577], 18);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

            L.marker([-6.98312305112442, 110.46219552383577]).addTo(map)
                .bindPopup('Zonakamera Semarang')
                .openPopup();
        });
    </script>
@endpush
