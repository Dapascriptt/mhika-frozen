<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        return $this->renderListing($request);
    }

    public function category(Request $request, Category $category)
    {
        return $this->renderListing($request, $category);
    }

    public function show(Product $product)
    {
        abort_unless($product->is_active, 404);

        $product->load('category');
        $relatedProducts = Product::with('category')
            ->where('is_active', true)
            ->whereKeyNot($product->id)
            ->when($product->category_id, fn ($query) => $query->where('category_id', $product->category_id))
            ->latest()
            ->take(4)
            ->get();

        return view('pages.product-detail', compact('product', 'relatedProducts'));
    }

    private function renderListing(Request $request, ?Category $category = null)
    {
        $categories = Category::orderBy('name')->get();
        $selectedCategory = $category?->slug ?? $request->query('category');
        $search = trim((string) $request->query('q', ''));
        $currentCategoryName = $category?->name ?? $categories->firstWhere('slug', $selectedCategory)?->name;
        $productsBaseUrl = $category ? route('categories.show', $category->slug) : route('products.index');

        $products = Product::with('category')
            ->where('is_active', true)
            ->when($category, function ($query, Category $category) {
                $query->where('category_id', $category->id);
            })
            ->when(! $category && $selectedCategory, function ($query) use ($selectedCategory) {
                $query->whereHas('category', fn ($categoryQuery) => $categoryQuery->where('slug', $selectedCategory));
            })
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($searchQuery) use ($search) {
                    $searchQuery
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhereHas('category', function ($categoryQuery) use ($search) {
                            $categoryQuery->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('products.partials.product-grid', compact('products'))->render(),
            ]);
        }

        return view('pages.products', compact('products', 'categories', 'selectedCategory', 'search', 'currentCategoryName', 'productsBaseUrl'));
    }
}
