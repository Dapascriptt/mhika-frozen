<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products' => Product::count(),
            'categories' => Category::count(),
            'messages' => ContactMessage::count(),
            'unreadMessages' => ContactMessage::where('is_read', false)->count(),
            'activeProducts' => Product::where('is_active', true)->count(),
            'featuredProducts' => Product::where('is_featured', true)->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
