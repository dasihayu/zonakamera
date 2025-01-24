<?php

namespace App\Http\Controllers;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $page = Page::first();
        $products = Product::with('categories')->where('is_visible',  true)->take(5)->get();
        
        return view('pages.home',  compact('page',  'products'));
    }
    
    public function about()
    {
        $page = Page::first();
        
        return view('pages.home',  compact('page'));
    }
    
    public function product()
    {
        $page = Page::first();
        
        return view('pages.home',  compact('page'));
    }
    
    public function featured()
    {
        $page = Page::first();
        
        return view('pages.home',  compact('page'));
    }
    
    public function member()
    {
        $page = Page::first();
        
        return view('pages.home',  compact('page'));
    }
    
    public function info()
    {
        $page = Page::first();
        
        return view('pages.home',  compact('page'));
    }
}
