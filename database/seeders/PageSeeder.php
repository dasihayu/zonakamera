<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Page::exists()) {
            return;
        }

        Page::create([
            'home_banner_img' => $this->moveImage('home_banner.jpg'),
            'home_banner_title' => 'Find the Best Gear for Every Need',
            'home_banner_sub' => 'Rent cameras and photography gear easily, quickly, and at affordable prices',
            'home_about_img' => $this->moveImage('about.jpg'),
            'home_about_title' => 'We Have Been Here Since 2018',
            'home_about_sub' => 'Since 2018, we have been dedicated to providing high-quality camera rentals and services. With over 1,500+ satisfied customers and a consistent 5-star rating, we are proud to be your trusted partner in capturing unforgettable moments.',
            'about_banner' => $this->moveImage('about_banner.jpg'),
            'about_image' => $this->moveImage('about_img.jpg'),
            'about_content_title' => 'High-Quality Camera Equipment for Every Need',
            'about_content_desctiption' => 'We provide top-notch camera gear designed to meet the needs of every photographer and videographer. Our equipment is sourced from trusted brands, ensuring reliability and performance for your projects, whether it’s for personal use or professional productions.',
            'about_map_title' => 'Where you can find us',
            'about_map_text' => 'Find our location on the map below and visit us for more information or assistance. We are always here to help you.',
            'product_banner' => $this->moveImage('product_banner.jpg'),
            'featured_banner' => $this->moveImage('featured_banner.jpg'),
            'booking_banner' => $this->moveImage('booking_banner.jpg'),
            'cart_banner' => $this->moveImage('cart_banner.jpg'),
        ]);
    }

    private function moveImage($filename)
    {
        $source = public_path("images/{$filename}");
        $destination = "images/{$filename}";

        if (File::exists($source) && !Storage::exists($destination)) {
            Storage::put($destination, File::get($source));
            return "images/{$filename}";
        }
        return Storage::exists($destination) ? "images/{$filename}" : null;
    }
}
