<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'artist']);

        $products = $query->latest()->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    public function create(Request $request)
    {
        $artists = Artist::query()->get();

        $categories = Category::orderBy('sort_order')->orderBy('name')->get();

        return view('admin.products.create', compact('artists', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'medium'      => 'nullable|string|max:255',
            'price'       => 'required|integer|min:0',
            'description' => 'nullable|string',
            'artist_id'   => 'required|exists:artists,id',
            'image'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product, Request $request)
    {
        $artists = Artist::query()->get();

        $categories = Category::orderBy('sort_order')->orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'artists', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'medium'      => 'nullable|string|max:255',
            'price'       => 'required|integer|min:0',
            'description' => 'nullable|string',
            'artist_id'   => 'required|exists:artists,id',
            'is_sold'     => 'boolean',
            'is_featured' => 'boolean',
            'image'       => 'nullable|image|max:2048',
        ]);

        $validated['is_sold'] = $request->boolean('is_sold');
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            if ($product->image) Storage::disk('public')->delete($product->image);
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        if ($product->image) Storage::disk('public')->delete($product->image);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
