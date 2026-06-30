<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::query()->firstOrCreate(['id' => 1], [
            'site_name' => 'GandengTangan',
            'whatsapp_number' => config('whatsapp.admin_number', '6281361428113'),
        ]);

        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'whatsapp_number' => 'required|string|max:30',
            'contact_email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:500',
            'short_description' => 'nullable|string|max:1000',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'favicon' => 'nullable|image|mimes:jpg,jpeg,png,webp,ico|max:1024',
        ]);

        $setting = Setting::query()->firstOrCreate(['id' => 1]);
        $validated['whatsapp_number'] = $this->normalizeWhatsappNumber($validated['whatsapp_number']);

        foreach (['logo', 'favicon'] as $field) {
            if ($request->hasFile($field)) {
                if ($setting->{$field}) {
                    Storage::disk('public')->delete(preg_replace('#^(storage/|public/)#', '', ltrim($setting->{$field}, '/')));
                }
                $validated[$field] = $request->file($field)->store('brand', 'public');
            } else {
                unset($validated[$field]);
            }
        }

        $setting->update($validated);

        return redirect()->route('admin.settings.edit')->with('success', 'Pengaturan berhasil disimpan.');
    }

    private function normalizeWhatsappNumber(string $number): string
    {
        $number = preg_replace('/\D+/', '', $number);

        if (str_starts_with($number, '0')) {
            return '62'.substr($number, 1);
        }

        return $number;
    }
}
