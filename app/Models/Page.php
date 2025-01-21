<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'home_banner_img',
        'home_banner_title',
        'home_banner_sub',
        'home_about_img',
        'home_about_title',
        'home_about_sub',
        'about_banner',
        'about_image',
        'about_content_title',
        'about_content_desctiption',
        'about_map_title',
        'about_map_text',
        'product_banner',
        'featured_banner',
        'member_banner',
        'info_banner',
    ];
}
