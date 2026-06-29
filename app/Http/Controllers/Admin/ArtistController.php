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
            'photo'           => 'nullable|image|max:2048',
        ]);

        $validated['organization_id'] = Organization::query()->value('id');
        $validated['avatar'] = strtoupper(substr($validated['name'], 0, 1));

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('artists', 'images');
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
            'photo'           => 'nullable|image|max:2048',
        ]);

        $validated['avatar'] = strtoupper(substr($validated['name'], 0, 1));

        if ($request->hasFile('photo')) {
            $this->deletePhoto($artist->photo);
            $validated['photo'] = $request->file('photo')->store('artists', 'images');
        }

        $artist->update($validated);

        return redirect()->route('admin.artists.index')->with('success', 'Data pengrajin berhasil diperbarui!');
    }

    public function destroy(Artist $artist)
    {
        $this->deletePhoto($artist->photo);
        $artist->delete();

        return redirect()->route('admin.artists.index')->with('success', 'Data pengrajin berhasil dihapus!');
    }

    private function deletePhoto(?string $path): void
    {
        if (!$path || str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return;
        }

        Storage::disk('images')->delete($path);
        Storage::disk('public')->delete($path);
    }
}
