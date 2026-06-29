<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
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
        $settings = Setting::query()->first();

        return view('admin.products.create', compact('artists', 'categories', 'settings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'medium'      => 'nullable|string|max:255',
            'price'       => 'required|integer|min:0',
            'stock'       => 'required|integer|min:0',
            'description' => 'nullable|string',
            'artist_id'   => 'required|exists:artists,id',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'whatsapp_number' => 'nullable|string|max:30',
        ]);

        $validated['is_sold'] = ((int) $validated['stock']) === 0;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $this->saveWhatsappNumber($validated['whatsapp_number'] ?? null);
        unset($validated['whatsapp_number']);

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product, Request $request)
    {
        $artists = Artist::query()->get();

        $categories = Category::orderBy('sort_order')->orderBy('name')->get();
        $settings = Setting::query()->first();

        return view('admin.products.edit', compact('product', 'artists', 'categories', 'settings'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'medium'      => 'nullable|string|max:255',
            'price'       => 'required|integer|min:0',
            'stock'       => 'required|integer|min:0',
            'description' => 'nullable|string',
            'artist_id'   => 'required|exists:artists,id',
            'is_sold'     => 'boolean',
            'is_featured' => 'boolean',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'whatsapp_number' => 'nullable|string|max:30',
        ]);

        $validated['is_sold'] = $request->boolean('is_sold') || ((int) $validated['stock']) === 0;
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            if ($product->image) Storage::disk('public')->delete($product->image);
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $this->saveWhatsappNumber($validated['whatsapp_number'] ?? null);
        unset($validated['whatsapp_number']);

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete(preg_replace('#^(storage/|public/)#', '', ltrim($product->image, '/')));
        }
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus!');
    }

    private function saveWhatsappNumber(?string $number): void
    {
        $number = $this->normalizeWhatsappNumber($number);

        if (!$number) {
            return;
        }

        Setting::query()->updateOrCreate(
            ['id' => 1],
            ['whatsapp_number' => $number]
        );
    }

    private function normalizeWhatsappNumber(?string $number): ?string
    {
        if (!$number) {
            return null;
        }

        $number = preg_replace('/\D+/', '', $number);

        if (str_starts_with($number, '0')) {
            return '62' . substr($number, 1);
        }

        return $number;
    }
}
