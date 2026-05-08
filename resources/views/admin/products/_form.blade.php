@csrf

<div class="row g-4">
    <div class="col-lg-8">
        <div class="bg-white border rounded p-4">
            <div class="mb-3">
                <label class="form-label" for="name">Nama Produk</label>
                <input class="form-control @error('name') is-invalid @enderror" id="name" type="text" name="name" value="{{ old('name', $product->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="category_id">Kategori</label>
                <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                    <option value="">Tanpa Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected((string) old('category_id', $product->category_id) === (string) $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="price">Harga</label>
                <input class="form-control @error('price') is-invalid @enderror" id="price" type="number" min="0" step="100" name="price" value="{{ old('price', $product->price ?? 0) }}" required>
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="description">Deskripsi</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="bg-white border rounded p-4">
            <div class="mb-3">
                <label class="form-label" for="image">Gambar</label>
                <input class="form-control @error('image') is-invalid @enderror" id="image" type="file" name="image" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Maksimal 2MB. Format jpg, jpeg, png, webp.</div>
            </div>

            @if ($product->image)
                @php
                    $adminImagePaths = \Illuminate\Support\Str::startsWith($product->image, ['assets/', 'images/'])
                        ? [$product->image]
                        : ['images/products/thumbs/' . $product->image, 'images/products/originals/' . $product->image];
                    $adminImage = collect($adminImagePaths)->first(fn ($path) => file_exists(public_path($path))) ?? 'assets/img/product-1.jpg';
                @endphp
                <img class="img-fluid rounded border mb-3" src="{{ asset($adminImage) }}" alt="{{ $product->name }}" width="300" height="300">
            @endif

            <div class="form-check form-switch mb-2">
                <input class="form-check-input" id="is_active" type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active ?? true))>
                <label class="form-check-label" for="is_active">Status Aktif</label>
            </div>
            <div class="form-check form-switch mb-4">
                <input class="form-check-input" id="is_featured" type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $product->is_featured ?? false))>
                <label class="form-check-label" for="is_featured">Produk Unggulan</label>
            </div>

            <button class="btn btn-primary w-100" type="submit">Simpan</button>
            <a class="btn btn-outline-secondary w-100 mt-2" href="{{ route('admin.products.index') }}">Batal</a>
        </div>
    </div>
</div>
