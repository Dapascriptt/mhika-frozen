<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

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

        $hasCategoryFilter = $category || $selectedCategory;

        $productsQuery = Product::query()
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
            });

        $products = $hasCategoryFilter
            ? $productsQuery->with('category')->latest()->paginate(12)->withQueryString()
            : $this->balancedProductPaginator($request, $productsQuery, $categories);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('products.partials.product-grid', compact('products'))->render(),
            ]);
        }

        return view('pages.products', compact('products', 'categories', 'selectedCategory', 'search', 'currentCategoryName', 'productsBaseUrl'));
    }

    private function balancedProductPaginator(Request $request, $productsQuery, $categories): LengthAwarePaginator
    {
        $perPage = 12;
        $page = LengthAwarePaginator::resolveCurrentPage();

        $categoryOrder = $categories
            ->pluck('id')
            ->values()
            ->flip();

        $groups = (clone $productsQuery)
            ->select('id', 'category_id', 'is_featured', 'created_at')
            ->orderByDesc('is_featured')
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->get()
            ->groupBy(fn ($product) => $product->category_id ?? 0)
            ->sortBy(fn ($group, $categoryId) => $categoryOrder[$categoryId] ?? PHP_INT_MAX);

        $balancedIds = [];
        $maxRows = $groups->max(fn ($group) => $group->count()) ?? 0;

        for ($row = 0; $row < $maxRows; $row++) {
            foreach ($groups as $group) {
                if (isset($group[$row])) {
                    $balancedIds[] = $group[$row]->id;
                }
            }
        }

        $pageIds = array_slice($balancedIds, ($page - 1) * $perPage, $perPage);
        $positions = array_flip($pageIds);

        $products = Product::with('category')
            ->whereIn('id', $pageIds)
            ->get()
            ->sortBy(fn ($product) => $positions[$product->id])
            ->values();

        return new LengthAwarePaginator($products, count($balancedIds), $perPage, $page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
    }
}
