<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $productsQuery = Product::query()->with(['artist', 'category']);

        $stats = [
            'products' => (clone $productsQuery)->count(),
            'featured_products' => (clone $productsQuery)->where('is_featured', true)->count(),
            'sold_products' => (clone $productsQuery)->where('is_sold', true)->count(),
            'available_products' => (clone $productsQuery)->where('is_sold', false)->count(),
            'users' => User::count(),
            'artists' => Artist::count(),
            'categories' => Category::count(),
        ];

        $latestProducts = (clone $productsQuery)
            ->latest()
            ->limit(8)
            ->get();

        $latestArtists = Artist::query()
            ->withCount('products')
            ->latest()
            ->limit(6)
            ->get();

        return view('admin.dashboard', compact('stats', 'latestProducts', 'latestArtists'));
    }
}
