<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtistController extends Controller
{
    public function index(Request $request)
    {
        $query = Artist::with('organization')->withCount('products');

        $artists = $query->latest()->paginate(15);

        return view('admin.artists.index', compact('artists'));
    }

    public function create(Request $request)
    {
        $types = ['Teman Tuli', 'Teman Netra', 'Teman Daksa', 'Teman Autis', 'Teman Grahita'];
        return view('admin.artists.create', compact('types'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'disability_type' => 'required|string',
            'bio'             => 'nullable|string',
            'skill'           => 'nullable|string|max:255',
            'is_active'       => 'boolean',
            'photo'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['organization_id'] = Organization::query()->value('id')
            ?? Organization::query()->create([
                'name' => 'GandengTangan',
                'icon' => '🤝',
                'description' => 'Organisasi utama GandengTangan',
            ])->id;
        $validated['avatar'] = strtoupper(substr($validated['name'], 0, 1));

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('artists', 'public');
        }

        Artist::create($validated);

        return redirect()->route('admin.artists.index')->with('success', 'Pengrajin berhasil ditambahkan!');
    }

    public function edit(Artist $artist)
    {
        $types = ['Teman Tuli', 'Teman Netra', 'Teman Daksa', 'Teman Autis', 'Teman Grahita'];
        return view('admin.artists.edit', compact('artist', 'types'));
    }

    public function update(Request $request, Artist $artist)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'disability_type' => 'required|string',
            'bio'             => 'nullable|string',
            'skill'           => 'nullable|string|max:255',
            'is_active'       => 'boolean',
            'photo'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['avatar'] = strtoupper(substr($validated['name'], 0, 1));

        if ($request->hasFile('photo')) {
            if ($artist->photo) Storage::disk('public')->delete($artist->photo);
            $validated['photo'] = $request->file('photo')->store('artists', 'public');
        }

        $artist->update($validated);

        return redirect()->route('admin.artists.index')->with('success', 'Data pengrajin berhasil diperbarui!');
    }

    public function destroy(Artist $artist)
    {
        if ($artist->products()->exists()) {
            return redirect()->route('admin.artists.index')
                ->with('success', 'Pengrajin tidak dihapus karena masih memiliki produk. Pindahkan/hapus produk terlebih dahulu.');
        }

        if ($artist->photo) Storage::disk('public')->delete($artist->photo);
        $artist->delete();

        return redirect()->route('admin.artists.index')->with('success', 'Data pengrajin berhasil dihapus!');
    }
}
