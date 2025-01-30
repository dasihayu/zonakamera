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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Additional Styles Stack -->
    @stack('styles')
</head>

<body class="flex flex-col min-h-screen font-manrope">
    <!-- Navbar -->
    <nav class="fixed top-0 left-0 z-50 w-full bg-white">
        <div class="container px-4 mx-auto md:px-12">
            <div class="relative flex items-center justify-between py-5">
                <!-- Logo -->
                <img src="{{ asset('images/logo.png') }}" width="128" alt="Logo" class="z-20">

                <!-- Mobile menu button -->
                <button id="mobile-menu-button" class="z-20 p-2 md:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-16 6h16" />
                    </svg>
                </button>

                <!-- Navigation Menu -->
                <div id="nav-menu"
                    class="fixed inset-0 z-10 hidden w-full h-screen bg-white md:h-auto md:relative md:w-auto">
                    <!-- Mobile menu container -->
                    <div
                        class="flex flex-col items-center w-full h-full px-4 pt-24 pb-8 overflow-y-auto md:flex-row md:items-center md:space-x-6 md:pt-0 md:pb-0">
                        <!-- Navigation links container -->
                        <div
                            class="flex flex-col items-center w-full space-y-6 md:flex-row md:space-y-0 md:space-x-6 md:w-auto">
                            <a href="{{ route('home') }}"
                                class="w-full py-2 text-lg font-semibold text-center text-gray-800 hover:text-gray-600 md:w-auto {{ Route::is('home') ? 'border-b-2 border-primary' : '' }}">
                                Home
                            </a>
                            <a href="{{ route('about') }}"
                                class="w-full py-2 text-lg font-semibold text-center text-gray-800 hover:text-gray-600 md:w-auto {{ Route::is('about') ? 'border-b-2 border-primary' : '' }}">
                                About
                            </a>
                            <a href="{{ route('products') }}"
                                class="w-full py-2 text-lg font-semibold text-center text-gray-800 hover:text-gray-600 md:w-auto {{ Route::is('products') ? 'border-b-2 border-primary' : '' }}">
                                Product
                            </a>

                            @auth
                                <a href="{{ route('bookings.index') }}"
                                    class="w-full py-2 text-lg font-semibold text-center text-gray-800 hover:text-gray-600 md:w-auto {{ request()->is('bookings*') ? 'border-b-2 border-primary' : '' }}">
                                    My Bookings
                                </a>
                                <a href="{{ route('cart.index') }}"
                                    class="flex items-center justify-center w-full p-2 md:w-auto {{ Route::is('cart.index') ? 'bg-primary text-white' : 'text-gray-800' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                    </svg>
                                </a>
                            @else
                                <div class="flex flex-col w-full gap-4 mt-6 md:flex-row md:w-auto md:mt-0">
                                    <a href="{{ route('register') }}"
                                        class="w-full px-4 py-2 text-lg font-semibold text-center text-white rounded-lg bg-primary md:w-auto">
                                        Register
                                    </a>
                                    <a href="{{ route('login') }}"
                                        class="w-full px-4 py-2 text-lg font-semibold text-center text-gray-800 border rounded-lg border-primary md:w-auto">
                                        Login
                                    </a>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content with proper spacing for fixed navbar -->
    <main class="flex-grow mt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#F7F7F7] text-primary">
        <!-- Main Footer Content -->
        <div class="container px-4 py-12 mx-auto md:px-6">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
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
                        <!-- Other social media icons... -->
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ url('') }}" class="text-gray-400 hover:text-primary">Home</a></li>
                        <li><a href="{{ url('about') }}" class="text-gray-400 hover:text-primary">About Us</a></li>
                        <li><a href="{{ url('products') }}" class="text-gray-400 hover:text-primary">Products</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary">Contact</a></li>
                    </ul>
                </div>

                <!-- Products -->
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold">Products</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ url('products?category=Camera%20Sony') }}"
                                class="text-gray-400 hover:text-primary">Cameras</a></li>
                        <li><a href="{{ url('products?category=Lenses%20Sony') }}"
                                class="text-gray-400 hover:text-primary">Lenses</a></li>
                        <li><a href="{{ url('products?category=Audio') }}"
                                class="text-gray-400 hover:text-primary">Audio Equipment</a></li>
                        <li><a href="{{ url('products?category=Gimbal%20Stabilizer') }}"
                                class="text-gray-400 hover:text-primary">Stabilizers</a></li>
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
                        <!-- Other contact info... -->
                    </ul>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-gray-800">
            <div class="container px-4 py-4 mx-auto md:px-6">
                <div class="flex flex-col items-center justify-between md:flex-row">
                    <p class="text-sm text-gray-400">© 2025 Zonakamera. All rights reserved.</p>
                    <div class="flex mt-4 space-x-6 md:mt-0">
                        <a href="#" class="text-sm text-gray-400 hover:text-primary">Privacy Policy</a>
                        <a href="#" class="text-sm text-gray-400 hover:text-primary">Terms of Service</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Base Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite('resources/js/app.js')

    <!-- Mobile Menu Script -->
    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const navMenu = document.getElementById('nav-menu');

        mobileMenuButton.addEventListener('click', () => {
            navMenu.classList.toggle('hidden');
            document.body.classList.toggle('overflow-hidden'); // Prevent scrolling when menu is open
        });

        // Close menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!navMenu.contains(e.target) && !mobileMenuButton.contains(e.target)) {
                navMenu.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        });

        // Close menu when window is resized to desktop size
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) { // 768px is the md breakpoint in Tailwind
                navMenu.classList.remove('hidden');
                document.body.classList.remove('overflow-hidden');
            } else {
                navMenu.classList.add('hidden');
            }
        });
    </script>

    <!-- Additional Scripts Stack -->
    @stack('scripts')
</body>

</html>
