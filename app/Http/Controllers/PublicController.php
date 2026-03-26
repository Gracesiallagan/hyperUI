<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Artist;
use App\Models\Organization;
use Illuminate\Http\Request;

class PublicController extends Controller
{
public function index()
{
    // 1) Featured products (utama)
    $featured = Product::with(['artist.organization', 'category'])
        ->where('is_sold', false)
        ->where('is_featured', true)
        ->latest()
        ->take(6)
        ->get();

    // 2) Fallback: kalau featured kosong, ambil newest
    if ($featured->isEmpty()) {
        $featured = Product::with(['artist.organization', 'category'])
            ->where('is_sold', false)
            ->latest()
            ->take(6)
            ->get();
    }

    $stats = [
        'products' => Product::count(),
        'artists'  => \App\Models\Artist::count(),
        'orgs'     => Organization::count(),
        'sold'     => Product::where('is_sold', true)->count(),
    ];

    // kategori + beberapa produk per kategori untuk section home
    $categories = \App\Models\Category::orderBy('sort_order')->orderBy('name')->get();

    $productsByCategory = $categories->map(function ($cat) {
        $cat->setRelation(
            'home_products',
            Product::with(['artist.organization', 'category'])
                ->where('is_sold', false)
                ->where('category_id', $cat->id)
                ->latest()
                ->take(4)
                ->get()
        );
        return $cat;
    });

    $organizations = Organization::withCount('artists')->get();

    return view('public.index', [
        'featured' => $featured,
        'stats' => $stats,
        'organizations' => $organizations,
        'categories' => $categories,
        'productsByCategory' => $productsByCategory,
    ]);
}
public function gallery(Request $request)
{
    $query = Product::with(['artist.organization', 'category'])
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
        $product->load('artist.organization');
        $related = Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->take(4)->get();

        return view('public.show', compact('product', 'related'));
    }

    public function about()
    {
        $organizations = Organization::withCount(['artists', 'products'])->get();
        return view('public.about', compact('organizations'));
    }

    public function artists(Request $request)
    {
        $query = Artist::query()
            ->with('organization')
            ->withCount('products');

        if ($request->filled('type')) {
            $query->where('disability_type', $request->type);
        }

        if ($request->filled('org')) {
            $query->whereHas('organization', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->org}%");
            });
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('bio', 'like', "%{$search}%");
            });
        }

        $artists = $query->latest()->paginate(12);

        $types = ['Teman Tuli', 'Teman Netra', 'Teman Daksa', 'Teman Autis', 'Teman Grahita'];

        return view('public.artist', compact('artists', 'types'));
    }

    public function artistsShow(Artist $artist)
    {
        $artist->load(['organization', 'products' => function ($q) {
            $q->where('is_sold', false)->latest()->take(8);
        }, 'products.category', 'products.artist.organization']);

        return view('public.artistshow', compact('artist'));
    }
}
