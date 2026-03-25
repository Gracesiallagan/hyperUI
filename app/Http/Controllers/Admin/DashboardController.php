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
        $stats = [
            'users' => User::count(),
            'organizations' => Organization::count(),
            'artists' => Artist::count(),
            'categories' => Category::count(),
            'products' => Product::count(),
            'featured_products' => Product::where('is_featured', true)->count(),
            'sold_products' => Product::where('is_sold', true)->count(),
        ];

        $latestProducts = Product::with(['artist', 'category'])
            ->latest()
            ->limit(8)
            ->get();

        return view('admin.dashboard', compact('stats', 'latestProducts'));
    }
}