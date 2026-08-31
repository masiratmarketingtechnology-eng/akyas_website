<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category', 'creator');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->latest()->paginate(10);
        $categories = ProductCategory::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = ProductCategory::all();
        return view('admin.products.create', compact('categories'));
    }

    public function show(Product $product)
    {
        return redirect()->route('admin.products.edit', $product->id);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:product_categories,id',
            'name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'description' => 'required|string',
            'specs' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'thumbnails' => 'nullable|array',
            'thumbnails.*' => 'image|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
        ]);

        $validated['slug'] = $this->uniqueSlug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('products', 'public');
        }

        $validated['specs'] = $this->parseSpecs($validated['specs'] ?? null);
        $validated['created_by'] = auth()->id();

        $product = Product::create($validated);

        if ($request->hasFile('thumbnails')) {
            foreach ($request->file('thumbnails') as $index => $thumbnail) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $thumbnail->store('products/thumbnails', 'public'),
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:product_categories,id',
            'name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'description' => 'required|string',
            'specs' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'thumbnails' => 'nullable|array',
            'thumbnails.*' => 'image|max:2048',
            'delete_thumbnails' => 'nullable|array',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
        ]);

        $validated['slug'] = $this->uniqueSlug($validated['name'], $product->id);

        if ($request->hasFile('image')) {
            if ($product->image_path) {
                \Storage::disk('public')->delete($product->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('products', 'public');
        }

        $validated['specs'] = $this->parseSpecs($validated['specs'] ?? null);

        $product->update($validated);

        if ($request->boolean('delete_image') && $product->image_path) {
            \Storage::disk('public')->delete($product->image_path);
            $product->update(['image_path' => null]);
        }

        if (!empty($validated['delete_thumbnails'])) {
            foreach ($validated['delete_thumbnails'] as $imageId) {
                $image = ProductImage::find($imageId);
                if ($image && $image->product_id === $product->id) {
                    \Storage::disk('public')->delete($image->path);
                    $image->delete();
                }
            }
        }

        if ($request->hasFile('thumbnails')) {
            $maxOrder = $product->images()->max('sort_order') ?? -1;
            foreach ($request->file('thumbnails') as $index => $thumbnail) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $thumbnail->store('products/thumbnails', 'public'),
                    'sort_order' => $maxOrder + $index + 1,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->image_path) {
            \Storage::disk('public')->delete($product->image_path);
        }
        foreach ($product->images as $image) {
            \Storage::disk('public')->delete($image->path);
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    public function setPrimary(Product $product, ProductImage $image)
    {
        if ($image->product_id !== $product->id) {
            abort(404);
        }

        if ($product->image_path) {
            $maxOrder = $product->images()->max('sort_order') ?? -1;
            ProductImage::create([
                'product_id' => $product->id,
                'path' => $product->image_path,
                'sort_order' => $maxOrder + 1,
            ]);
        }

        $product->update(['image_path' => $image->path]);
        $image->delete();

        return redirect()->route('admin.products.edit', $product->id)->with('success', 'Primary image updated.');
    }

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $baseSlug = $slug;
        $counter = 1;

        $query = Product::where('slug', $slug);
        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        while ($query->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
            $query = Product::where('slug', $slug);
            if ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            }
        }

        return $slug;
    }

    private function parseSpecs(?string $specs): ?array
    {
        if (empty($specs)) {
            return null;
        }

        $specsArray = [];
        $lines = preg_split('/[\r\n]+/', $specs);
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            $parts = explode(':', $line, 2);
            if (count($parts) === 2) {
                $key = trim($parts[0]);
                $value = trim($parts[1]);
                if ($key !== '') {
                    $specsArray[$key] = $value;
                }
            }
        }

        return !empty($specsArray) ? $specsArray : null;
    }
}
