<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zonakamera - @yield('title')</title>

    <!-- Google Fonts for Manrope -->
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Base Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.css">
    @vite('resources/css/app.css')

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css" />

    <!-- Additional Styles Stack -->
    @stack('styles')
</head>

<body class="flex flex-col min-h-screen font-manrope">
    <!-- Navbar -->
    <nav class="fixed top-0 left-0 w-full bg-white z-50">
        <div class="container flex items-center justify-between px-12 py-5 mx-auto">
            <img src="{{ asset('images/logo.png') }}" width="128" alt="Logo">
            <ul>
                <li class="flex flex-row gap-6">
                    <a href="{{ route('home') }}"
                        class="text-lg font-semibold text-gray-800 hover:text-gray-600 {{ Route::is('home') ? 'border-b-2 border-primary' : '' }}">
                        Home
                    </a>
                    <a href="{{ route('about') }}"
                        class="text-lg font-semibold text-gray-800 hover:text-gray-600 {{ Route::is('about') ? 'border-b-2 border-primary' : '' }}">
                        About
                    </a>
                    <a href="{{ route('products') }}"
                        class="text-lg font-semibold text-gray-800 hover:text-gray-600 {{ Route::is('products') ? 'border-b-2 border-primary' : '' }}">
                        Product
                    </a>
                    {{-- <a href="{{ route('featured') }}"
                        class="text-lg font-semibold text-gray-800 hover:text-gray-600 {{ Route::is('featured') ? 'border-b-2 border-primary' : '' }}">
                        Featured
                    </a>
                    <a href="{{ route('products') }}"
                        class="text-lg font-semibold text-gray-800 hover:text-gray-600 {{ Route::is('products') ? 'border-b-2 border-primary' : '' }}">
                        Member
                    </a> --}}
                    {{-- <a href="{{ route('info') }}"
                        class="text-lg font-semibold text-gray-800 hover:text-gray-600 {{ Route::is('info') ? 'border-b-2 border-primary' : '' }}">
                        Info
                    </a> --}}
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow">
        <!-- Hero Section -->
        <div class="relative {{ request()->is('/') ? 'hidden' : '' }}">
            <!-- Background Image -->
            <img src="{{ asset('storage/' . $page->about_banner) }}" alt="Hero Image"
                class="w-full max-h-80 object-cover blur-sm" />
            <!-- Headline -->
            <div class="absolute inset-0 flex flex-col items-center justify-center text-center mt-16">
                <h1 class="text-6xl font-extrabold md:text-8xl drop-shadow-lg text-white">
                    @yield('title')
                </h1>
            </div>
        </div>


        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#F7F7F7] text-primary bottom-0">
        <!-- Main Footer Content -->
        <div class="container mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="space-y-4">
                    <h3 class="text-2xl font-bold">Zonakamera</h3>
                    <p class="text-gray-400">Your trusted partner for professional camera equipment rentals since 2018.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-primary">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-primary">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-primary">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-primary">Home</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary">Products</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary">Contact</a></li>
                    </ul>
                </div>

                <!-- Products -->
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold">Products</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-primary">Cameras</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary">Lenses</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary">Audio Equipment</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary">Stabilizers</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold">Contact Us</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Semarang, Indonesia</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>info@camerarent.com</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>+62 123 456 789</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-gray-800">
            <div class="container mx-auto px-6 py-4">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm">© 2025 Zonakamera. All rights reserved.</p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a href="#" class="text-gray-400 hover:text-primary text-sm">Privacy Policy</a>
                        <a href="#" class="text-gray-400 hover:text-primary text-sm">Terms of Service</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Base Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.js"></script>
    @vite('resources/js/app.js')

    <!-- Additional Scripts Stack -->
    @stack('scripts')
</body>

</html>
