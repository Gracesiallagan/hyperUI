<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Category;
use App\Models\Organization;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Query dasar products sesuai role
        $productsQuery = Product::query()->with(['artist.organization', 'category']);

        if ($user->role !== 'super_admin') {
            $productsQuery->whereHas('artist', function ($q) use ($user) {
                $q->where('organization_id', $user->organization_id);
            });
        }

        // Stats (dibatasi org jika bukan super_admin)
        $stats = [
            'products' => (clone $productsQuery)->count(),
            'featured_products' => (clone $productsQuery)->where('is_featured', true)->count(),
            'sold_products' => (clone $productsQuery)->where('is_sold', true)->count(),
            'available_products' => (clone $productsQuery)->where('is_sold', false)->count(),
        ];

        if ($user->role === 'super_admin') {
            $stats['users'] = User::count();
            $stats['organizations'] = Organization::count();
            $stats['artists'] = Artist::count();
            $stats['categories'] = Category::count();
        } else {
            $stats['users'] = 1; // hanya untuk tampilan (opsional)
            $stats['organizations'] = 1;
            $stats['artists'] = Artist::where('organization_id', $user->organization_id)->count();
            $stats['categories'] = Category::count(); // kategori global
        }

        $latestProducts = (clone $productsQuery)
            ->latest()
            ->limit(8)
            ->get();

        $latestArtistsQuery = Artist::query()->with('organization')->withCount('products');

        if ($user->role !== 'super_admin') {
            $latestArtistsQuery->where('organization_id', $user->organization_id);
        }

        $latestArtists = $latestArtistsQuery->latest()->limit(6)->get();

        return view('admin.dashboard', compact('stats', 'latestProducts', 'latestArtists'));
    }
}