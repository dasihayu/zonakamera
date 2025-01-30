<!-- About Section -->
<div class="flex flex-col items-center justify-center gap-8 px-4 my-12 md:flex-row md:my-24 md:px-6">
    <img src="{{ asset('storage/' . $page->home_about_img) }}"
        class="w-full md:w-1/2 max-w-[600px] rounded-xl object-cover" alt="About Image">
    <div class="flex flex-col w-full md:w-[500px] gap-2">
        <p class="text-center text-primary md:text-left">ABOUT US</p>
        <h1 class="text-3xl font-bold text-center md:text-5xl md:text-left">{{ $page->home_about_title }}</h1>
        <p class="text-center md:text-left">{{ $page->home_about_sub }}</p>
        <a href="{{ route('about') }}">
            <div class="flex flex-row items-center justify-center gap-1 mt-8 md:justify-start md:mt-12">
                <p class="text-primary hover:border-b-2 hover:border-primary">More Info</p>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2 text-primary" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7" />
                </svg>
            </div>
        </a>
    </div>
</div>
