<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Criteria;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    public function index()
    {
        $criterias = Criteria::orderBy('kode', 'asc')->get();
        return view('admin.criterias.index', compact('criterias'));
    }

    public function create()
    {
        return view('admin.criterias.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|unique:kriteria,kode',
            'nama' => 'required|string|max:255',
            'tipe' => 'required|in:benefit,cost',
        ]);

        // Default bobot 0, will be updated by AHP later
        $validated['bobot'] = 0;

        Criteria::create($validated);

        return redirect()->route('admin.criterias.index')->with('success', 'Kriteria berhasil ditambahkan.');
    }

    public function edit(Criteria $criteria)
    {
        return view('admin.criterias.edit', compact('criteria'));
    }

    public function update(Request $request, Criteria $criteria)
    {
        $validated = $request->validate([
            'kode' => 'required|unique:kriteria,kode,' . $criteria->id,
            'nama' => 'required|string|max:255',
            'tipe' => 'required|in:benefit,cost',
        ]);

        $criteria->update($validated);

        return redirect()->route('admin.criterias.index')->with('success', 'Kriteria berhasil diperbarui.');
    }

    public function destroy(Criteria $criteria)
    {
        $criteria->delete();
        return redirect()->route('admin.criterias.index')->with('success', 'Kriteria berhasil dihapus.');
    }
}
