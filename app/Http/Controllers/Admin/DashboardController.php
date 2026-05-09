<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products' => Product::count(),
            'categories' => Category::count(),
            'activeProducts' => Product::where('is_active', true)->count(),
            'featuredProducts' => Product::where('is_featured', true)->count(),
        ];

        $latestProducts = Product::with('category')->latest()->take(5)->get();
        $latestCategories = Category::withCount('products')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestProducts', 'latestCategories'));
    }
}
