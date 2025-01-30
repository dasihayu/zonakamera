@extends('layouts.layout')

@section('title', 'Home')

@section('content')
@include('components.users.hero')
@include('components.users.why')
@include('components.users.product')
@include('components.users.about')
@include('components.users.testimonial')
@include('components.users.video')
@endsection


@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const videoSwiper = new Swiper('.video-swiper', {
                slidesPerView: 2,
                spaceBetween: 30,
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    1024: {
                        slidesPerView: 6,
                        spaceBetween: 30,
                    },
                },
                autoplay: {
                    delay: 10000,
                    disableOnInteraction: false,
                },
            });

            const videos = document.querySelectorAll('.video-swiper video');

            videos.forEach(video => {
                video.removeAttribute('autoplay');

                video.muted = true;
                video.playsInline = true;

                video.parentElement.addEventListener('mouseenter', () => {
                    video.play().catch(e => console.log("Autoplay prevented:", e));
                });

                video.parentElement.addEventListener('mouseleave', () => {
                    video.pause();
                    video.currentTime = 0;
                });

                video.parentElement.addEventListener('touchstart', () => {
                    if (video.paused) {
                        video.play().catch(e => console.log("Autoplay prevented:", e));
                    } else {
                        video.pause();
                        video.currentTime = 0;
                    }
                });
            });
        });

        const testimonialSwiper = new Swiper('.testimonial-swiper', {
            slidesPerView: 1,
            spaceBetween: 15,
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
        });
    </script>
@endpush
