@extends('layouts.layout')

@section('title', 'About')

@section('content')
    <!-- Hero Section -->
    <div class="relative">
        <!-- Background Image -->
        <img src="{{ asset('storage/' . $page->about_banner) }}" alt="Hero Image" class="w-full max-h-80 object-cover blur-sm" />
        <!-- Headline -->
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center mt-16">
            <h1 class="text-6xl font-extrabold md:text-8xl drop-shadow-lg text-white">
                About Us
            </h1>
        </div>
    </div>

    <!-- About Section -->
    <div class="flex flex-row items-center justify-evenly text-center my-24 py-6 pr-6">
        <img src="{{ asset('storage/' . $page->about_image) }}" width="600" alt="" class="rounded-xl">
        <div class="flex flex-col w-[500px] gap-2">
            <p class="text-primary text-left">ABOUT US</p>
            <h1 class="font-bold text-5xl text-left">{{ $page->about_content_title }}</h1>
            <p class="text-left">{{ $page->about_content_desctiption }}</p>
        </div>
    </div>

    <div class="flex flex-row items-center justify-evenly text-center my-24 py-6 pr-6">
        <div class="flex flex-col w-[500px] gap-2">
            <h1 class="font-bold text-5xl text-left">{{ $page->about_map_title }}</h1>
            <p class="text-left">{{ $page->about_map_text }}</p>
        </div>
        <div id="map" class="w-full h-80 rounded-xl max-w-screen-sm"></div>
    </div>

@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const map = L.map('map').setView([-6.98312305112442, 110.46219552383577], 18);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            }).addTo(map);

            L.marker([-6.98312305112442, 110.46219552383577]).addTo(map)
                .bindPopup('Zonakamera Semarang')
                .openPopup();
        });
    </script>
@endpush
