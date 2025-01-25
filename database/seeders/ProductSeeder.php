<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Categories
        $categories = [
            ['name' => 'Sony'], // 1
            ['name' => 'Canon'], // 2
            ['name' => 'Fuji'], // 3
            ['name' => 'Lumix'], // 4
            ['name' => 'Camera Sony'], // 5
            ['name' => 'Camera Canon'], // 6
            ['name' => 'Camera Fuji'], // 7
            ['name' => 'Camera Lumix'], // 8
            ['name' => 'Lenses Sony'],  // 9
            ['name' => 'Lenses Canon'],  // 10
            ['name' => 'Lenses Fuji'],  // 11
            ['name' => 'Lenses Lumix'],  // 12
            ['name' => 'Gimbal Stabilizer'], // 13
            ['name' => 'Action Cam'], // 14
            ['name' => 'Camera Support'],  // 15
            ['name' => 'Lighting'],  // 16
            ['name' => 'Memory'],  // 17
            ['name' => 'Battery'],  // 18
            ['name' => 'Tripod'], // 19
            ['name' => 'Audio'], // 20
            ['name' => 'Drone'],  // 21
            ['name' => 'Converter'],  // 22
            ['name' => 'DJI'],  // 23
            ['name' => 'Gopro'],  // 24
            ['name' => 'Insta'],  // 25
            ['name' => 'Godox'],  // 26
        ];

        foreach ($categories as $index => $category) {
            $exists = DB::table('product_categories')->where('name', $category['name'])->exists();

            if (!$exists) {
                DB::table('product_categories')->insert([
                    'id' => $index + 1,
                    'name' => $category['name'],
                    'is_active' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Products
        $products = [
            [
                'title' => 'Sony A6000',
                'price' => 120000,
                'image_url' => 'a6000.jpg',
                'categories' => [1, 5]
            ],
            [
                'title' => 'Sony A6300',
                'price' => 135000,
                'image_url' => 'a6300.jpg',
                'categories' => [1, 5]
            ],
            [
                'title' => 'Sony A6400',
                'price' => 150000,
                'image_url' => 'a6400.jpg',
                'categories' => [1, 5]
            ],
            [
                'title' => 'Sony A6500',
                'price' => 150000,
                'image_url' => 'a6500.jpg',
                'categories' => [1, 5]
            ],
            [
                'title' => 'Sony A7 Mark II',
                'price' => 150000,
                'image_url' => 'a7ii.jpg',
                'categories' => [1, 5]
            ],
            [
                'title' => 'Sony A7 Mark III',
                'price' => 230000,
                'image_url' => 'a7iii_best seller.jpg',
                'categories' => [1, 5]
            ],
            [
                'title' => 'Sony A7R Mark III',
                'price' => 250000,
                'image_url' => 'A7RIII.jpg',
                'categories' => [1, 5]
            ],
            [
                'title' => 'Sony A7C',
                'price' => 250000,
                'image_url' => 'a7c.jpg',
                'categories' => [1, 5]
            ],
            [
                'title' => 'Sony A7 Mark IV',
                'price' => 350000,
                'image_url' => 'a7iv.jpg',
                'categories' => [1, 5]
            ],
            [
                'title' => 'Sony FX 30',
                'price' => 250000,
                'image_url' => 'fx30.jpg',
                'categories' => [1, 5]
            ],
            [
                'title' => 'Sony NX100',
                'price' => 250000,
                'image_url' => 'Sony Nx100_web.jpg',
                'categories' => [1, 5]
            ],
            [
                'title' => 'Canon 550D',
                'price' => 70000,
                'image_url' => 'Canon 550d_web.jpg',
                'categories' => [2, 6]
            ],
            [
                'title' => 'Canon 1200D',
                'price' => 70000,
                'image_url' => 'Canon 1200d_web.jpg',
                'categories' => [2, 6]
            ],
            [
                'title' => 'Canon 1300D',
                'price' => 80000,
                'image_url' => 'Canon 1300_web.jpg',
                'categories' => [2, 6]
            ],
            [
                'title' => 'Canon 600D',
                'price' => 90000,
                'image_url' => 'Canon 600d_web.jpg',
                'categories' => [2, 6]
            ],
            [
                'title' => 'Canon 750D',
                'price' => 120000,
                'image_url' => 'Canon 750d_web.jpg',
                'categories' => [2, 6]
            ],
            [
                'title' => 'Canon 60D',
                'price' => 120000,
                'image_url' => 'Canon 60D_web.jpg',
                'categories' => [2, 6]
            ],
            [
                'title' => 'Canon 6D',
                'price' => 150000,
                'image_url' => 'Canon 6D_web.jpg',
                'categories' => [2, 6]
            ],
            [
                'title' => 'Canon M100',
                'price' => 100000,
                'image_url' => 'Canon m100_web.jpg',
                'categories' => [2, 6]
            ],
            [
                'title' => 'Canon EOS R',
                'price' => 250000,
                'image_url' => 'Canon eos R_web.jpg',
                'categories' => [2, 6]
            ],
            [
                'title' => 'Fuji XA3',
                'price' => 100000,
                'image_url' => 'Fuji XA3.jpg',
                'categories' => [3, 7]
            ],
            [
                'title' => 'Fuji XT100',
                'price' => 110000,
                'image_url' => 'Fuji XT100.jpg',
                'categories' => [3, 7]
            ],
            [
                'title' => 'Fuji XH1',
                'price' => 150000,
                'image_url' => 'Fuji xh1_web_best seller.jpg',
                'categories' => [3, 7]
            ],
            [
                'title' => 'Fuji XT4',
                'price' => 250000,
                'image_url' => 'Fuji Xt4_web.jpg',
                'categories' => [3, 7]
            ],
            [
                'title' => 'Lumix G85',
                'price' => 100000,
                'image_url' => 'lumix g85_web.jpg',
                'categories' => [4, 8]
            ],
            [
                'title' => 'Lumix G9',
                'price' => 150000,
                'image_url' => 'lumix g9_web.jpg',
                'categories' => [1, 8]
            ],
            [
                'title' => 'Sony 35mm f1.8',
                'price' => 60000,
                'image_url' => '35mm oss.jpg',
                'categories' => [1, 9]
            ],
            [
                'title' => 'Sony 28mm f2',
                'price' => 60000,
                'image_url' => '28mm.jpg',
                'categories' => [1, 9]
            ],
            [
                'title' => 'Sony 50mm f1.8',
                'price' => 40000,
                'image_url' => '50mm sony.jpg',
                'categories' => [1, 9]
            ],
            [
                'title' => 'Sony 85mm f1.8',
                'price' => 75000,
                'image_url' => '85mm sony.jpg',
                'categories' => [1, 9]
            ],
            [
                'title' => 'Sony 18-105mm f4',
                'price' => 60000,
                'image_url' => '18- 105mm.jpg',
                'categories' => [1, 9]
            ],
            [
                'title' => 'Sigma 16mm f1.4',
                'price' => 60000,
                'image_url' => '16mm sigma.jpg',
                'categories' => [1, 9]
            ],
            [
                'title' => 'Sigma 30mm f1.4',
                'price' => 50000,
                'image_url' => '30mm sigma.jpg',
                'categories' => [1, 9]
            ],
            [
                'title' => 'Sigma 35mm f1.4 Art',
                'price' => 150000,
                'image_url' => 'sigma 35mm f1.4.jpg',
                'categories' => [1, 9]
            ],
            [
                'title' => 'Tamron 17-28mm f2.8',
                'price' => 150000,
                'image_url' => 'Lensa Sony Tamron 17-28mm_web.jpg',
                'categories' => [1, 9]
            ],
            [
                'title' => 'Tamron 28-75mm f2.8',
                'price' => 150000,
                'image_url' => '28-75mm tamron.jpg',
                'categories' => [1, 9]
            ],
            [
                'title' => 'Sony 35mm f1.8 fe',
                'price' => 120000,
                'image_url' => '35mm fe sony.jpg',
                'categories' => [1, 9]
            ],
            [
                'title' => 'Zeiss 35mm f1.4',
                'price' => 170000,
                'image_url' => 'zeiss 35mm.jpg',
                'categories' => [1, 9]
            ],
            [
                'title' => 'Zeiss 50mm f1.4',
                'price' => 150000,
                'image_url' => '50mm zeiss.jpg',
                'categories' => [1, 9]
            ],
            [
                'title' => 'Zeiss 55mm f1.8',
                'price' => 120000,
                'image_url' => 'zeiss 55mm.jpg',
                'categories' => [1, 9]
            ],
            [
                'title' => 'Sony 70-200mm f4',
                'price' => 150000,
                'image_url' => '70 200 f4 sony.jpg',
                'categories' => [1, 9]
            ],
            [
                'title' => 'Sony 24-70mm f2.8 GM',
                'price' => 230000,
                'image_url' => '24 - 70 GM.jpg',
                'categories' => [1, 9]
            ],
            [
                'title' => 'Canon 18-55mm',
                'price' => 15000,
                'image_url' => 'kit stm canon 18-55.jpg',
                'categories' => [1, 10]
            ],
            [
                'title' => 'Yongnuo 35mm f2',
                'price' => 35000,
                'image_url' => '35mm canon yn.jpg',
                'categories' => [2, 10]
            ],
            [
                'title' => 'Canon 50mm f1.8 STM',
                'price' => 35000,
                'image_url' => '50mm stm.jpg',
                'categories' => [2, 10]
            ],
            [
                'title' => 'Canon 50mm f1.4 USM',
                'price' => 50000,
                'image_url' => '50mm usm.jpg',
                'categories' => [2, 10]
            ],
            [
                'title' => 'Canon 10-22mm',
                'price' => 60000,
                'image_url' => '10-22 canon.jpg',
                'categories' => [2, 10]
            ],
            [
                'title' => 'Sigma 18-35mm f1.8',
                'price' => 120000,
                'image_url' => '18- 105mm.jpg',
                'categories' => [2, 10]
            ],
            [
                'title' => 'Sigma 35mm f1.4 Art',
                'price' => 120000,
                'image_url' => '35mm sigma canon.jpg',
                'categories' => [2, 10]
            ],
            [
                'title' => 'Canon 17-40mm f4',
                'price' => 80000,
                'image_url' => '17-40mm canon.jpg',
                'categories' => [2, 10]
            ],
            [
                'title' => 'Canon 16-35mm f2.8',
                'price' => 150000,
                'image_url' => '16-35mm canon.jpg',
                'categories' => [2, 10]
            ],
            [
                'title' => 'Canon 24-70mm f2.8 IS I',
                'price' => 150000,
                'image_url' => '24-70mm canon mark i.jpg',
                'categories' => [2, 10]
            ],
            [
                'title' => 'Canon 24-70mm f2.8 IS II',
                'price' => 160000,
                'image_url' => '24-70 canon mark ii.jpg',
                'categories' => [2, 10]
            ],
            [
                'title' => 'Canon 70-200mm f4',
                'price' => 80000,
                'image_url' => 'canon 70-200 f4.jpg',
                'categories' => [2, 10]
            ],
            [
                'title' => 'Canon 70-200mm f2.8 non IS',
                'price' => 130000,
                'image_url' => 'canon 70-200 nonnis.jpg',
                'categories' => [2, 10]
            ],
            [
                'title' => 'Canon 70-200mm f2.8 IS II',
                'price' => 180000,
                'image_url' => '70 - 200 canon is ii.jpg',
                'categories' => [2, 10]
            ],
            [
                'title' => 'Fuji 16-50mm',
                'price' => 20000,
                'image_url' => 'lensa fuji kit 16-50.jpg',
                'categories' => [3, 11]
            ],
            [
                'title' => 'Fujinon 23mm f1.4',
                'price' => 100000,
                'image_url' => 'fuji 23mm_web best seller.jpg.png',
                'categories' => [3, 11]
            ],
            [
                'title' => 'Fujinon 35mm f1.4',
                'price' => 65000,
                'image_url' => '35mm fuji_web best seller.jpg',
                'categories' => [3, 11]
            ],
            [
                'title' => 'Fujinon 56mm f1.2',
                'price' => 120000,
                'image_url' => '56mm fuji_web new arrival.jpg',
                'categories' => [3, 11]
            ],
            [
                'title' => 'Viltrox 33mm f1.4',
                'price' => 20000,
                'image_url' => 'viltrox 33mm_web best price.jpg',
                'categories' => [3, 11]
            ],
            [
                'title' => 'Viltrox 56mm f1.4',
                'price' => 60000,
                'image_url' => 'lensa fuji kit 16-50.jpg',
                'categories' => [3, 11]
            ],
            [
                'title' => 'Fuji 16-50mm',
                'price' => 20000,
                'image_url' => 'viltrox 56mm_web best price.jpg',
                'categories' => [3, 11]
            ],
            [
                'title' => 'Fujinon 50-230mm',
                'price' => 60000,
                'image_url' => '50-200 fuji_web.jpg',
                'categories' => [3, 11]
            ],
            [
                'title' => 'Fujinon 18-55 f2.8',
                'price' => 50000,
                'image_url' => 'kit fuji 18-55mm_web.jpg',
                'categories' => [3, 11]
            ],
            [
                'title' => 'Lumix 25mm f1.7',
                'price' => 35000,
                'image_url' => 'lumix 25mm_web.jpg',
                'categories' => [4, 12]
            ],
            [
                'title' => 'Sigma 16mm f1.4',
                'price' => 60000,
                'image_url' => 'sigma lumx 16mm.jpg',
                'categories' => [4, 12]
            ],
            [
                'title' => 'Sigma 20mm f1.4',
                'price' => 50000,
                'image_url' => 'lumix sigma 30mm_web.jpg',
                'categories' => [4, 12]
            ],
            [
                'title' => 'Voigtlander 25mm f0.95',
                'price' => 65000,
                'image_url' => 'lumix voix_web.jpg',
                'categories' => [4, 12]
            ],
            [
                'title' => 'Crane Plus',
                'price' => 150000,
                'image_url' => 'crane plus.jpg',
                'categories' => [13]
            ],
            [
                'title' => 'Crane 2',
                'price' => 160000,
                'image_url' => 'crane 2.jpg',
                'categories' => [13]
            ],
            [
                'title' => 'Weebil S',
                'price' => 150000,
                'image_url' => 'weebil s.jpg',
                'categories' => [13]
            ],
            [
                'title' => 'Ronin SC 2',
                'price' => 175000,
                'image_url' => 'ronin sc2.jpg',
                'categories' => [23, 13]
            ],
            [
                'title' => 'Ronin RS3 Mini',
                'price' => 150000,
                'image_url' => 'ronin rs3 mini.jpg',
                'categories' => [23, 13]
            ],
            [
                'title' => 'Ronin S',
                'price' => 170000,
                'image_url' => 'Ronin S.jpg',
                'categories' => [23, 13]
            ],
            [
                'title' => 'Gopro Hero 10',
                'price' => 140000,
                'image_url' => 'gopro 10.jpg',
                'categories' => [14, 24]
            ],
            [
                'title' => 'Gopro Hero 12',
                'price' => 150000,
                'image_url' => 'gopro12_best seller.jpg',
                'categories' => [14, 24]
            ],
            [
                'title' => 'Insta 360 Ace Pro',
                'price' => 150000,
                'image_url' => 'acepro_best seller.jpg',
                'categories' => [14, 25]
            ],
            [
                'title' => 'Insta 360 X3',
                'price' => 170000,
                'image_url' => 'insta x3.jpg',
                'categories' => [14, 25]
            ],
            [
                'title' => 'Led Kecil',
                'price' => 25000,
                'image_url' => 'led kecil.jpg',
                'categories' => [15, 16]
            ],
            [
                'title' => 'Led RGB Portable',
                'price' => 35000,
                'image_url' => 'led rbg.jpg',
                'categories' => [15, 16]
            ],
            [
                'title' => 'Yongnuo 900',
                'price' => 75000,
                'image_url' => 'yn 900.jpg',
                'categories' => [15, 16]
            ],
            [
                'title' => 'Godox 500C',
                'price' => 75000,
                'image_url' => 'yn 900.jpg',
                'categories' => [15, 16]
            ],
            [
                'title' => 'Godox SL60',
                'price' => 80000,
                'image_url' => 'sl 60.jpg',
                'categories' => [15, 16]
            ],
            [
                'title' => 'Godox SL150 III',
                'price' => 125000,
                'image_url' => 'sl 150iii.jpg',
                'categories' => [15, 16]
            ],
            [
                'title' => 'Godox SK400 Set',
                'price' => 140000,
                'image_url' => 'sk400 set.jpg',
                'categories' => [15, 16]
            ],
            [
                'title' => 'Godox TT600',
                'price' => 30000,
                'image_url' => 'tt600.jpg',
                'categories' => [15, 16]
            ],
            [
                'title' => 'Godox TT685',
                'price' => 35000,
                'image_url' => 'tt685.jpg',
                'categories' => [15, 16]
            ],
            [
                'title' => 'Godox V850',
                'price' => 50000,
                'image_url' => 'v850.jpg',
                'categories' => [15, 16]
            ],
            [
                'title' => 'Godox TL30 (2pcs)',
                'price' => 90000,
                'image_url' => 'godox tl30.jpg',
                'categories' => [15, 16]
            ],
            [
                'title' => 'Trigger Godox',
                'price' => 20000,
                'image_url' => 'yn 900.jpg',
                'categories' => [15, 16]
            ],
            [
                'title' => 'Light Stand',
                'price' => 15000,
                'image_url' => 'light stand.jpg',
                'categories' => [15, 16]
            ],
            [
                'title' => 'Tripod',
                'price' => 30000,
                'image_url' => 'tripod.jpg',
                'categories' => [15, 19]
            ],
            [
                'title' => 'Tripod Video Libec',
                'price' => 40000,
                'image_url' => 'tripod libec.jpg',
                'categories' => [15, 19]
            ],
            [
                'title' => 'Recorder Sony',
                'price' => 35000,
                'image_url' => 'recorder sony.jpg',
                'categories' => [15, 20]
            ],
            [
                'title' => 'Zoom H1N',
                'price' => 40000,
                'image_url' => 'zoom h1n.jpg',
                'categories' => [15, 20]
            ],
            [
                'title' => 'Saramonic Blink',
                'price' => 60000,
                'image_url' => 'saramonic blink.jpg',
                'categories' => [15, 20]
            ],
            [
                'title' => 'Takara X3',
                'price' => 50000,
                'image_url' => 'takara x3.jpg',
                'categories' => [15, 20]
            ],
            [
                'title' => 'Mic Rode',
                'price' => 35000,
                'image_url' => 'mic rode.jpg',
                'categories' => [15, 20]
            ],
            [
                'title' => 'Mic Boya',
                'price' => 30000,
                'image_url' => 'mic boya.jpg',
                'categories' => [15, 20]
            ],
            [
                'title' => 'Converter Procore (sony to canon)',
                'price' => 25000,
                'image_url' => 'procore.jpg',
                'categories' => [15, 22]
            ],
            [
                'title' => 'Converter Viltrox (sony to canon)',
                'price' => 25000,
                'image_url' => 'viltrox ev iv.jpg',
                'categories' => [15, 22]
            ],
            [
                'title' => 'Converter Viltrox (lumix to canon)',
                'price' => 30000,
                'image_url' => 'lumix to canon.jpg',
                'categories' => [15, 22]
            ],
            [
                'title' => 'Converter Canon RF',
                'price' => 30000,
                'image_url' => 'canon rf converter.jpg',
                'categories' => [15, 22]
            ],
            [
                'title' => 'Battery LP-E8',
                'price' => 20000,
                'image_url' => 'batrei le e8.jpg',
                'categories' => [15, 18]
            ],
            [
                'title' => 'Battery LP-E6N',
                'price' => 25000,
                'image_url' => 'battrei 6d.jpg',
                'categories' => [15, 18]
            ],
            [
                'title' => 'Battery Fujifilm',
                'price' => 25000,
                'image_url' => 'batrei fuji.jpg',
                'categories' => [15, 18]
            ],
            [
                'title' => 'Battery NP-FW50',
                'price' => 25000,
                'image_url' => 'battrei np50.jpg',
                'categories' => [15, 18]
            ],
            [
                'title' => 'Battery FZ100',
                'price' => 40000,
                'image_url' => 'batrei fz100.jpg',
                'categories' => [15, 18]
            ],
            [
                'title' => 'Battery NP-F970',
                'price' => 25000,
                'image_url' => 'np-f970.jpg',
                'categories' => [15, 18]
            ],
            [
                'title' => 'Sandisk 16gb',
                'price' => 10000,
                'image_url' => '16gb.jpg',
                'categories' => [15, 17]
            ],
            [
                'title' => 'Sandisk 32gb',
                'price' => 15000,
                'image_url' => '32gb.jpg',
                'categories' => [15, 17]
            ],
            [
                'title' => 'Sandisk Extreme 64gb',
                'price' => 30000,
                'image_url' => '64gb.jpg',
                'categories' => [15, 17]
            ],
            [
                'title' => 'Sandisk Extreme 128gb',
                'price' => 40000,
                'image_url' => '128gb.jpg',
                'categories' => [15, 17]
            ],
            [
                'title' => 'Sony Tough 64gb, 128gb',
                'price' => 50000,
                'image_url' => 'sony tough.jpg',
                'categories' => [15, 17]
            ],
            [
                'title' => 'DJI Mavic Air 2',
                'price' => 500000,
                'image_url' => 'mavic air 2 _best seller.jpg',
                'categories' => [21, 23]
            ],
        ];

        foreach ($products as $index => $product) {
            $exists = DB::table('products')->where('title', $product['title'])->exists();

            if (!$exists) {
                // Move image to storage
                $oldPath = public_path('images/products/' . $product['image_url']);
                $newPath = 'product_image/' . $product['image_url'];

                if (File::exists($oldPath) && !Storage::disk('public')->exists($newPath)) {
                    Storage::disk('public')->put($newPath, File::get($oldPath));
                }

                // Insert product
                DB::table('products')->insert([
                    'id' => $index + 1,
                    'title' => $product['title'],
                    'price' => $product['price'],
                    'image_url' => $newPath,
                    'is_visible' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Attach categories
                foreach ($product['categories'] as $categoryId) {
                    $relationExists = DB::table('product_category')
                        ->where('product_id', $index + 1)
                        ->where('category_id', $categoryId)
                        ->exists();

                    if (!$relationExists) {
                        DB::table('product_category')->insert([
                            'product_id' => $index + 1,
                            'category_id' => $categoryId,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }
    }
}
