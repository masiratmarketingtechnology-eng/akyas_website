<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::withCount('products')->latest()->get();
        return view('admin.product-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.product-categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        ProductCategory::create($validated);

        return redirect()->route('admin.product-categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(ProductCategory $product_category)
    {
        return view('admin.product-categories.edit', ['category' => $product_category]);
    }

    public function update(Request $request, ProductCategory $product_category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name,' . $product_category->id,
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $product_category->update($validated);

        return redirect()->route('admin.product-categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(ProductCategory $product_category)
    {
        $product_category->delete();
        return redirect()->route('admin.product-categories.index')->with('success', 'Category deleted successfully.');
    }
}
