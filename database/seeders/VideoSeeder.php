<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Video;

class VideoSeeder extends Seeder
{
    public function run()
    {
        $titles = [
            'Sony 70-200mm f/2.8 GM Lens Review', 'DJI Ronin RS3 Mini Hands-on', 'DJI Avata 2 First Impressions',
            'Handy Talkie Usage Guide', 'Sony A7IV Camera Overview', 'Business Hours 07:00 - 22:00',
            'Sony A7IV + 24-70mm f/2.8 GM Setup'
        ];

        $descriptions = [
            'A detailed review of the Sony 70-200mm f/2.8 GM lens and its performance.',
            'Testing and reviewing the DJI Ronin RS3 Mini gimbal for professional videography.',
            'First look and impressions of the DJI Avata 2 drone for aerial cinematography.',
            'How to use a handy talkie effectively in various scenarios.',
            'An in-depth look at the Sony A7IV camera and its features.',
            'Operating hours for the business, open from 07:00 to 22:00.',
            'A complete setup guide for the Sony A7IV paired with the 24-70mm f/2.8 GM lens.'
        ];

        $videoFiles = File::files(public_path('video'));

        foreach ($videoFiles as $index => $file) {
            $fileName = $file->getFilename();
            $newPath = "videos/{$fileName}";

            // Pindahkan video ke storage/videos
            Storage::disk('public')->put($newPath, File::get($file));

            // Simpan data ke database dengan title dan deskripsi yang sesuai
            Video::create([
                'title' => $titles[$index % count($titles)],
                'url' => $newPath,
                'description' => $descriptions[$index % count($descriptions)],
                'is_active' => true,
            ]);
        }
    }
}