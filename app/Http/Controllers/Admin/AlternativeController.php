<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alternative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlternativeController extends Controller
{
    public function index()
    {
        $alternatives = Alternative::all();
        return view('admin.alternatives.index', compact('alternatives'));
    }

    public function create()
    {
        return view('admin.alternatives.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_warna' => 'required|string|max:255',
            'kode_warna' => 'required|string|max:50',
            'gambar_warna' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        if ($request->hasFile('gambar_warna')) {
            $path = $request->file('gambar_warna')->store('alternatives', 'public');
            $validated['gambar_warna'] = $path;
        }

        Alternative::create($validated);

        return redirect()->route('admin.alternatives.index')->with('success', 'Alternatif warna berhasil ditambahkan.');
    }

    public function edit(Alternative $alternative)
    {
        return view('admin.alternatives.edit', compact('alternative'));
    }

    public function update(Request $request, Alternative $alternative)
    {
        $validated = $request->validate([
            'nama_warna' => 'required|string|max:255',
            'kode_warna' => 'required|string|max:50',
            'gambar_warna' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        if ($request->hasFile('gambar_warna')) {
            // Delete old image
            if ($alternative->gambar_warna && Storage::disk('public')->exists($alternative->gambar_warna)) {
                Storage::disk('public')->delete($alternative->gambar_warna);
            }
            $path = $request->file('gambar_warna')->store('alternatives', 'public');
            $validated['gambar_warna'] = $path;
        }

        $alternative->update($validated);

        return redirect()->route('admin.alternatives.index')->with('success', 'Alternatif warna berhasil diperbarui.');
    }

    public function destroy(Alternative $alternative)
    {
        if ($alternative->gambar_warna && Storage::disk('public')->exists($alternative->gambar_warna)) {
            Storage::disk('public')->delete($alternative->gambar_warna);
        }
        $alternative->delete();
        return redirect()->route('admin.alternatives.index')->with('success', 'Alternatif warna berhasil dihapus.');
    }
}
