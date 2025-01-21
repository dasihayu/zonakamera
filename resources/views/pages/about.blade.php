@extends('layouts.layout')

@section('title', 'About')

@section('content')
    <!-- Hero Section -->
    <div class="relative">
        <!-- Background Image -->
        <img src="{{ asset('images/banner.jpg') }}" alt="Hero Image" class="w-full max-h-80 object-cover blur-sm" />
        <!-- Headline -->
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center mt-16">
            <h1 class="text-6xl font-extrabold md:text-8xl drop-shadow-lg text-white">
                About Us
            </h1>
        </div>
    </div>

    <!-- About Section -->
    <div class="flex flex-row items-center justify-evenly text-center my-24 py-6 pr-6">
        <img src="{{ asset('images/about.jpg') }}" width="600" alt="" class="rounded-xl">
        <div class="flex flex-col w-[500px] gap-2">
            <p class="text-primary text-left">ABOUT US</p>
            <h1 class="font-bold text-5xl text-left">We Have Been Here Since 2018</h1>
            <p class="text-left">Since 2018, we have been dedicated to providing high-quality camera rentals and services.
                With over 1,500+ satisfied customers and a consistent 5-star rating, we are proud to be your trusted partner
                in capturing unforgettable moments.</p>
        </div>
    </div>

    <div class="flex flex-row items-center justify-evenly text-center my-24 py-6 pr-6">
        <div class="flex flex-col w-[500px] gap-2">
            <h1 class="font-bold text-5xl text-left">High-Quality Camera Equipment for Every Need</h1>
            <p class="text-left">We provide top-notch camera gear designed to meet the needs of every photographer and
                videographer. Our equipment is sourced from trusted brands, ensuring reliability and performance for your
                projects, whether it’s for personal use or professional productions.</p>
            <a href="{{ route('products') }}">
                <div class="flex flex-row items-center mt-12 gap-1">
                    <p class="text-primary hover:border-b-2 hover:border-primary">More Info</p>
                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 w-4 h-4 text-primary" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </div>
            </a>
        </div>
        <div class="grid grid-cols-2 gap-4 max-w-[600px]">
            <div class="space-y-4">
                <!-- Column 1 -->
                <div class="overflow-hidden rounded-lg">
                    <img src="{{ asset('images/download.jpg') }}" alt="Image 1" class="w-full h-auto object-cover">
                </div>
                <div class="overflow-hidden rounded-lg">
                    <img src="{{ asset('images/download (1).jpg') }}" alt="Image 3" class="w-full h-auto object-cover">
                </div>
            </div>
            <div class="space-y-4">
                <!-- Column 2 -->
                <div class="overflow-hidden rounded-lg">
                    <img src="{{ asset('images/download (2).jpg') }}" alt="Image 2" class="w-full h-auto object-cover">
                </div>
                <div class="overflow-hidden rounded-lg">
                    <img src="{{ asset('images/download (3).webp') }}" alt="Image 3" class="w-full h-auto object-cover">
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-row items-center justify-evenly text-center my-24 py-6 pr-6">
        <div id="map" class="w-full h-80 rounded-xl max-w-screen-sm"></div>
        <div class="flex flex-col w-[500px] gap-2">
            <h1 class="font-bold text-5xl text-left">Where you can find us</h1>
            <p class="text-left">Since 2018, we have been dedicated to providing high-quality camera rentals and services.
                With over 1,500+ satisfied customers and a consistent 5-star rating, we are proud to be your trusted partner
                in capturing unforgettable moments.</p>
        </div>
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
