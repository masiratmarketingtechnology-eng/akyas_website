<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\Certificate;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function products(Request $request)
    {
        $filter = $request->string('filter')->toString();
        $search = $request->string('search')->toString();

        $query = Product::with('category');

        if ($filter && $filter !== 'all') {
            $query->whereHas('category', fn ($q) => $q->where('slug', $filter));
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('tagline', 'like', "%{$search}%");
            });
        }

        $products = $query->latest()->get();
        $categories = ProductCategory::all();

        return view('pages.products', [
            'products' => $products,
            'categories' => $categories,
            'filter' => $filter ?: 'all',
            'search' => $search,
        ]);
    }

    public function product(string $slug)
    {
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();

        $relatedProducts = Product::with('category')
            ->where('id', '!=', $product->id)
            ->where('category_id', $product->category_id)
            ->take(4)
            ->get();

        return view('pages.product-show', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }

    public function certificates()
    {
        return view('pages.certificates', [
            'certificates' => Certificate::orderBy('sort_order')->get(),
        ]);
    }

    public function viewCertificate(Certificate $certificate)
    {
        $path = storage_path('app/public/' . $certificate->file_path);

        if (!file_exists($path)) {
            abort(404);
        }

        $content = file_get_contents($path);
        $mime = mime_content_type($path);

        return response($content, 200, [
            'Content-Type' => $mime,
            'Content-Disposition' => 'inline; filename="' . basename($certificate->file_path) . '"',
            'Content-Length' => filesize($path),
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    public function blog(Request $request)
    {
        $filter = $request->string('filter')->toString();

        $query = BlogPost::with('category');

        if ($filter && $filter !== 'all') {
            $query->whereHas('category', fn ($q) => $q->where('slug', $filter));
        }

        $posts = $query->latest()->get();
        $featuredPost = BlogPost::with('category')->latest()->first();
        $categories = BlogCategory::all();

        return view('pages.blog', [
            'featuredPost' => $featuredPost,
            'posts' => $posts,
            'categories' => $categories,
            'filter' => $filter ?: 'all',
        ]);
    }

    public function blogPost(string $slug)
    {
        $post = BlogPost::with('category')->where('slug', $slug)->firstOrFail();

        $relatedPosts = BlogPost::with('category')
            ->where('id', '!=', $post->id)
            ->take(3)
            ->latest()
            ->get();

        return view('pages.blog-show', [
            'post' => $post,
            'relatedPosts' => $relatedPosts,
        ]);
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
