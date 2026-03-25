<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Organization;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $featured = Product::with('artist.organization', 'category')
            ->where('is_featured', true)
            ->where('is_sold', false)
            ->take(4)
            ->get();

        $stats = [
            'products' => Product::count(),
            'artists'  => \App\Models\Artist::count(),
            'orgs'     => Organization::count(),
            'sold'     => Product::where('is_sold', true)->count(),
        ];

        $organizations = Organization::withCount('artists')->get();

        return view('public.index', compact('featured', 'stats', 'organizations'));
    }

    public function gallery(Request $request)
    {
        $query = Product::with('artist.organization', 'category')->where('is_sold', false);

        if ($request->filled('category') && $request->category !== 'Semua') {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }

        if ($request->filled('type')) {
            $query->whereHas('artist', fn($q) => $q->where('disability_type', $request->type));
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('artist', fn($a) => $a->where('name', 'like', "%{$search}%"));
            });
        }

        $products   = $query->latest()->paginate(12);
        $categories = Category::where('is_active', true)->orderBy('sort_order')->get();
        $types      = ['Teman Tuli', 'Teman Netra', 'Teman Daksa', 'Teman Autis', 'Teman Grahita'];

        return view('public.gallery', compact('products', 'categories', 'types'));
    }

    public function show(Product $product)
    {
        $product->load('artist.organization', 'category');
        $related = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)->get();

        return view('public.show', compact('product', 'related'));
    }

    public function about()
    {
        $organizations = Organization::withCount(['artists', 'products'])->get();
        return view('public.about', compact('organizations'));
    }
}
