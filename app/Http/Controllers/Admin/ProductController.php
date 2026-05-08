<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $product = new Product([
            'is_active' => true,
            'is_featured' => false,
        ]);

        return view('admin.products.create', compact('categories', 'product'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateProduct($request);
        unset($validated['image']);

        $validated['slug'] = $this->uniqueSlug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            $validated['image'] = $this->storeImage($request);
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Product $product)
    {
        $product->load('category');

        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.products.edit', compact('categories', 'product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $this->validateProduct($request);
        unset($validated['image']);

        $validated['slug'] = $this->uniqueSlug($validated['name'], $product->id);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            $this->deleteImage($product->image);
            $validated['image'] = $this->storeImage($request);
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $this->deleteImage($product->image);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }

    private function validateProduct(Request $request): array
    {
        $request->merge([
            'price' => preg_replace('/\D/', '', (string) $request->input('price', '0')) ?: 0,
        ]);

        return $request->validate([
            'name' => 'required|string|max:150',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
        ]);
    }

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $counter = 2;

        while (Product::where('slug', $slug)->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        return $slug;
    }

    private function storeImage(Request $request): string
    {
        $file = $request->file('image');
        $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '-' . time() . '.' . $file->getClientOriginalExtension();
        $originalPath = public_path('images/products/originals');
        $thumbPath = public_path('images/products/thumbs');

        File::ensureDirectoryExists($originalPath);
        File::ensureDirectoryExists($thumbPath);

        $file->move($originalPath, $filename);
        $this->createThumbnail($originalPath . DIRECTORY_SEPARATOR . $filename, $thumbPath . DIRECTORY_SEPARATOR . $filename);

        return $filename;
    }

    private function createThumbnail(string $sourcePath, string $targetPath): void
    {
        if (! function_exists('imagecreatetruecolor')) {
            File::copy($sourcePath, $targetPath);
            return;
        }

        $imageSize = getimagesize($sourcePath);

        if (! $imageSize) {
            File::copy($sourcePath, $targetPath);
            return;
        }

        [$width, $height, $type] = $imageSize;
        $source = match ($type) {
            IMAGETYPE_JPEG => imagecreatefromjpeg($sourcePath),
            IMAGETYPE_PNG => imagecreatefrompng($sourcePath),
            IMAGETYPE_WEBP => function_exists('imagecreatefromwebp') ? imagecreatefromwebp($sourcePath) : null,
            default => null,
        };

        if (! $source) {
            File::copy($sourcePath, $targetPath);
            return;
        }

        $size = 300;
        $thumb = imagecreatetruecolor($size, $size);
        imagealphablending($thumb, false);
        imagesavealpha($thumb, true);

        $scale = max($size / $width, $size / $height);
        $newWidth = (int) ceil($width * $scale);
        $newHeight = (int) ceil($height * $scale);
        $dstX = (int) (($size - $newWidth) / 2);
        $dstY = (int) (($size - $newHeight) / 2);

        imagecopyresampled($thumb, $source, $dstX, $dstY, 0, 0, $newWidth, $newHeight, $width, $height);

        match ($type) {
            IMAGETYPE_JPEG => imagejpeg($thumb, $targetPath, 82),
            IMAGETYPE_PNG => imagepng($thumb, $targetPath, 6),
            IMAGETYPE_WEBP => function_exists('imagewebp') ? imagewebp($thumb, $targetPath, 82) : File::copy($sourcePath, $targetPath),
            default => File::copy($sourcePath, $targetPath),
        };

        imagedestroy($source);
        imagedestroy($thumb);
    }

    private function deleteImage(?string $image): void
    {
        if (! $image || Str::startsWith($image, ['assets/', 'images/'])) {
            return;
        }

        foreach (['images/products/originals', 'images/products/thumbs'] as $directory) {
            $path = public_path($directory . '/' . $image);
            if (File::exists($path)) {
                File::delete($path);
            }
        }
    }
}
