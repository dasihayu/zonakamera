<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_id',
        'title',
        'is_visible',
        'price',
        'description',
        'image_url'
    ];

    protected static function booted()
    {
        static::creating(function ($product) {
            if (!$product->product_id) {
                $product->product_id = $product->generateUniqueId();
            }
        });
    }

    /**
     * Ekstrak 2-4 karakter model atau seri dari nama produk
     */
    protected function extractModelCode($title)
    {
        // Bersihkan spasi dan ubah ke huruf besar
        $title = strtoupper(preg_replace('/\s+/', '', $title));

        // Ambil angka atau kombinasi angka-huruf dari judul produk
        preg_match('/\d+[A-Z]?\d*/', $title, $matches);

        if (!empty($matches[0])) {
            return substr($matches[0], 0, 4); // Ambil 2-4 karakter pertama dari model
        }

        return 'XX'; // Default jika tidak ditemukan model
    }

    public function generateUniqueId()
    {
        // Ambil kategori pertama dari produk
        $category = $this->categories()->first();
        $categoryName = $category ? $category->name : 'GEN';

        // Ambil 3 huruf pertama dari kategori (tanpa spasi dan simbol)
        $categoryPart = strtoupper(substr(Str::slug($categoryName, ''), 0, 3));

        // Ambil 3 huruf pertama dari nama produk (tanpa spasi dan simbol)
        $productPart = strtoupper(substr(Str::slug($this->title, ''), 0, 3));

        // Ambil kode model (angka atau kombinasi angka-huruf)
        $modelPart = $this->extractModelCode($this->title);

        // Generate angka acak 5 digit
        $randomPart = str_pad(mt_rand(10000, 99999), 5, '0', STR_PAD_LEFT);

        // Gabungkan format ID
        $newId = "{$categoryPart}-{$productPart}-{$modelPart}-{$randomPart}";

        // Pastikan ID unik dalam database
        while (static::where('product_id', $newId)->exists()) {
            $randomPart = str_pad(mt_rand(10000, 99999), 5, '0', STR_PAD_LEFT);
            $newId = "{$categoryPart}-{$productPart}-{$modelPart}-{$randomPart}";
        }

        return $newId;
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_category', 'product_id', 'category_id');
    }

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_product')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    public function getPriceForUser(?User $user = null): float
    {
        if ($user && $user->is_member) {
            return $this->price * 0.9; // 10% discount for members
        }

        return $this->price;
    }
}
