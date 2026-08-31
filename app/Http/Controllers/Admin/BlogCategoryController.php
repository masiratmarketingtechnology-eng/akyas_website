<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::withCount('posts')->latest()->get();
        return view('admin.blog-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.blog-categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories,name',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        BlogCategory::create($validated);

        return redirect()->route('admin.blog-categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(BlogCategory $blog_category)
    {
        return view('admin.blog-categories.edit', ['category' => $blog_category]);
    }

    public function update(Request $request, BlogCategory $blog_category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories,name,' . $blog_category->id,
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $blog_category->update($validated);

        return redirect()->route('admin.blog-categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(BlogCategory $blog_category)
    {
        $blog_category->delete();
        return redirect()->route('admin.blog-categories.index')->with('success', 'Category deleted successfully.');
    }
}
