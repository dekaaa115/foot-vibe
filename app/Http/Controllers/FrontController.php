<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->take(10)->get();
        $popularProducts = Product::where('is_popular', true)->latest()->get();

        // Ambil semua produk, nanti akan disembunyikan dan dimunculkan per 6 item pakai JS
        $dailyDiscovery = Product::latest()->get();

        return view('front.index', compact('popularProducts', 'dailyDiscovery', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('front.detail', compact('product'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::where('category_id', $category->id)->latest()->get();

        return view('front.category', compact('category', 'products'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('q');
        $products = Product::where('name', 'like', "%{$keyword}%")
            ->orWhere('description', 'like', "%{$keyword}%")
            ->latest()
            ->get();

        return view('front.search', compact('products', 'keyword'));
    }

    public function popular()
    {
        $products = Product::where('is_popular', true)->latest()->get();
        $title = "Popular Products Collection";
        return view('front.all_products', compact('products', 'title'));
    }

    public function allProducts()
    {
        $products = Product::latest()->get();
        $title = "Daily Discovery / All Sneakers";
        return view('front.all_products', compact('products', 'title'));
    }

    public function storeReview(Request $request, $slug)
    {
        if (!Auth::check()) {
            return redirect()->back()->withErrors(['Kamu harus login terlebih dahulu untuk memberikan ulasan.']);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048' // Validasi file gambar maksimal 2MB
        ]);

        $product = Product::where('slug', $slug)->firstOrFail();

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('reviews', 'public');
        }

        \App\Models\Review::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'image' => $imagePath
        ]);

        return back()->with('success', 'Terima kasih! Ulasan kamu berhasil ditambahkan.');
    }
}
