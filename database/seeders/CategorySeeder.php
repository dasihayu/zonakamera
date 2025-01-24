<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Sony',
            'Canon',
            'Fuji',
            'Lumix',
            'Gimbal Stabilizer',
            'Action Cam',
            'Camera Support', 
            'Camera',
            'Lens',
        ];

        foreach ($categories as $category) {
            ProductCategory::create(['name' => $category, 'is_active' => true]);
        }
    }
}
