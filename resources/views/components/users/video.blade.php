<!-- Instagram Video Section -->
<div class="container mx-auto my-24">
    <h2 class="mb-12 text-5xl font-bold text-center">Follow Our Instagram</h2>

    <!-- Swiper -->
    <div class="swiper video-swiper">
        <div class="swiper-wrapper">
            @foreach ($videos as $video)
                <div class="relative swiper-slide group">
                    <a href="instagram.com/zonakamerasemarang">
                        <video class="object-cover w-full rounded-lg h-128" muted>
                            <source src="{{ Storage::url($video->url) }}" type="video/mp4">
                        </video>
                        <div
                            class="absolute inset-0 flex flex-col items-center justify-center p-4 text-white transition-opacity duration-300 bg-black bg-opacity-50 rounded-lg opacity-0 group-hover:opacity-100">
                            <h3 class="mb-2 text-xl font-bold text-center">{{ $video->title }}</h3>
                            <p class="text-sm text-center">{{ $video->description }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Navigation Buttons -->
        <div class="swiper-button-next text-primary"></div>
        <div class="swiper-button-prev text-primary"></div>
        <!-- Pagination -->
        <div class="swiper-pagination"></div>
    </div>
</div>
