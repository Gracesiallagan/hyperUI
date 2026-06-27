<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PublicController extends Controller
{
public function index()
{
    // 1) Featured products (utama)
    $featured = Product::with(['artist', 'category'])
        ->where('is_sold', false)
        ->where('is_featured', true)
        ->latest()
        ->take(6)
        ->get();

    // 2) Fallback: kalau featured kosong, ambil newest
    if ($featured->isEmpty()) {
        $featured = Product::with(['artist', 'category'])
            ->where('is_sold', false)
            ->latest()
            ->take(6)
            ->get();
    }

    $stats = [
        'products' => Product::count(),
        'artists'  => \App\Models\Artist::count(),
        'sold'     => Product::where('is_sold', true)->count(),
    ];

    // kategori + beberapa produk per kategori untuk section home
    $categories = \App\Models\Category::orderBy('sort_order')->orderBy('name')->get();

    $productsByCategory = $categories->map(function ($cat) {
        $cat->setRelation(
            'home_products',
            Product::with(['artist', 'category'])
                ->where('is_sold', false)
                ->where('category_id', $cat->id)
                ->latest()
                ->take(4)
                ->get()
        );
        return $cat;
    });

    return view('public.index', [
        'featured' => $featured,
        'stats' => $stats,
        'categories' => $categories,
        'productsByCategory' => $productsByCategory,
    ]);
}
public function gallery(Request $request)
{
    $query = Product::with(['artist', 'category'])
        ->where('is_sold', false);

    // filter category
    if ($request->filled('category') && $request->category !== 'Semua') {
        $query->whereHas('category', function ($q) use ($request) {
            $q->where('slug', $request->category)
              ->orWhere('name', $request->category);
        });
    }

    // filter disability type
    if ($request->filled('type')) {
        $query->whereHas('artist', fn($q) => $q->where('disability_type', $request->type));
    }

    // search
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhereHas('artist', fn($a) => $a->where('name', 'like', "%{$search}%"));
        });
    }

    $products = $query->latest()->paginate(12);

    // kategori dari database (lebih rapi)
    $categories = \App\Models\Category::orderBy('sort_order')->orderBy('name')->get();
    $types = ['Teman Tuli', 'Teman Netra', 'Teman Daksa', 'Teman Autis', 'Teman Grahita'];

    return view('public.gallery', compact('products', 'categories', 'types'));
}

    public function show(Product $product)
{
    $product->load('artist', 'category');
    $related = Product::with(['artist', 'category'])
        ->where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->where('is_sold', false)
        ->take(4)->get();

    return view('public.show', compact('product', 'related'));
}

    public function about()
    {
        return view('public.about');
    }
}
