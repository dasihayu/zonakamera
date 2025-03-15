<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Product;
use App\Models\Video;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $page = Page::first();
        $videos = Video::where('is_active', true)->get();
        $products = Product::with('categories')
            ->where('is_visible', true)
            ->withCount('bookings')
            ->orderBy('bookings_count', 'desc')
            ->take(5)
            ->get();

        if ($products->isEmpty()) {
            $products = Product::with('categories')
            ->where('is_visible', true)
            ->inRandomOrder()
            ->take(5)
            ->get();
        }

        return view('pages.home',  compact('page',  'products', 'videos'));
    }

    public function about()
    {
        $page = Page::first();

        return view('pages.about',  compact('page'));
    }

    public function product(Request $request)
    {
        $page = Page::first();
        $categories = ProductCategory::all();

        $query = Product::with('categories')->where('is_visible', true);

        if ($request->has('category') && $request->category) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('name', $request->category);
            });
        }
        
        if ($request->has('price_range')) {
            $query->where('price', '<=', $request->price_range);
        }


        if ($request->has('search') && $request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $products = $query->paginate(30);

        return view('pages.product', compact('page', 'products', 'categories'));
    }

    public function showProduct($id)
    {
        $page = Page::first();
        $product = Product::findOrFail($id);

        return view('pages.product-show', compact('page', 'product'));
    }


    // public function featured()
    // {
    //     $page = Page::first();

    //     return view('pages.featured',  compact('page'));
    // }

    // public function member()
    // {
    //     $page = Page::first();

    //     return view('pages.home',  compact('page'));
    // }

    // public function info()
    // {
    //     $page = Page::first();

    //     return view('pages.info',  compact('page'));
    // }
}
