<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubKriteria;
use App\Models\Criteria;
use Illuminate\Http\Request;

class SubKriteriaController extends Controller
{
    public function index()
    {
        $criterias = Criteria::with('subKriteria')->orderBy('id', 'asc')->get();
        return view('admin.sub_kriteria.index', compact('criterias'));
    }

    public function create()
    {
        $criterias = Criteria::orderBy('id', 'asc')->get();
        return view('admin.sub_kriteria.create', compact('criterias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kriteria_id' => 'required|exists:kriteria,id',
            'nama' => 'required|string|max:255',
            'nilai' => 'required|numeric|min:0'
        ]);

        SubKriteria::create($request->all());

        return redirect()->route('admin.sub-kriteria.index')->with('success', 'Sub Kriteria berhasil ditambahkan.');
    }

    public function edit(SubKriteria $subKriterium)
    {
        $criterias = Criteria::orderBy('id', 'asc')->get();
        return view('admin.sub_kriteria.edit', compact('subKriterium', 'criterias'));
    }

    public function update(Request $request, SubKriteria $subKriterium)
    {
        $request->validate([
            'kriteria_id' => 'required|exists:kriteria,id',
            'nama' => 'required|string|max:255',
            'nilai' => 'required|numeric|min:0'
        ]);

        $subKriterium->update($request->all());

        return redirect()->route('admin.sub-kriteria.index')->with('success', 'Sub Kriteria berhasil diperbarui.');
    }

    public function destroy(SubKriteria $subKriterium)
    {
        $subKriterium->delete();
        return redirect()->route('admin.sub-kriteria.index')->with('success', 'Sub Kriteria berhasil dihapus.');
    }
}
