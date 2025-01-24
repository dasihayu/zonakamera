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

        $products = $query->paginate(60);

        return view('pages.product', compact('page', 'products', 'categories'));
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
