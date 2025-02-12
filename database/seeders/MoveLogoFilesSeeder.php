<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class MoveLogoFilesSeeder extends Seeder
{
    public function run()
    {
        $files = [
            'logo.png',
            'logo.ico'
        ];

        foreach ($files as $file) {
            $sourcePath = public_path('images/sites/' . $file);
            $destinationPath = storage_path('app/public/sites/' . $file);

            try {
                // Create sites directory if it doesn't exist
                if (!File::exists(storage_path('app/public/sites'))) {
                    File::makeDirectory(storage_path('app/public/sites'), 0755, true);
                }

                // Check if source file exists
                if (File::exists($sourcePath)) {
                    // Copy file to storage
                    File::copy($sourcePath, $destinationPath);

                    Log::info("Successfully moved {$file} to storage/sites");
                    $this->command->info("Successfully moved {$file} to storage/sites");
                } else {
                    Log::warning("Source file not found: {$sourcePath}");
                    $this->command->warn("Source file not found: {$sourcePath}");
                }
            } catch (\Exception $e) {
                Log::error("Error moving {$file}: " . $e->getMessage());
                $this->command->error("Error moving {$file}: " . $e->getMessage());
            }
        }

        // Remind about storage link
        $this->command->info("Remember to run 'php artisan storage:link' if you haven't already!");
    }
}