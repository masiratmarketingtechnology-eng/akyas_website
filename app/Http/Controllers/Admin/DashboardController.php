<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\BlogPost;
use App\Models\ContactEnquiry;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products' => Product::count(),
            'blog_posts' => BlogPost::count(),
            'enquiries' => ContactEnquiry::count(),
            'unread_enquiries' => ContactEnquiry::whereNull('read_at')->count(),
        ];

        $recentEnquiries = ContactEnquiry::latest()->take(5)->get();
        $recentPosts = BlogPost::latest()->take(5)->get();
        $recentProducts = Product::with('category', 'creator')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentEnquiries', 'recentPosts', 'recentProducts'));
    }
}
