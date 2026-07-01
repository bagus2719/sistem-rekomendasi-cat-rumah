<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\AlternativeValue;
use Illuminate\Http\Request;

class AlternativeValueController extends Controller
{
    public function index()
    {
        $alternatives = Alternative::all();
        $criterias = Criteria::orderBy('kode', 'asc')->get();
        
        // Fetch existing values
        $values = AlternativeValue::all()->keyBy(function($item) {
            return $item->alternatif_id . '-' . $item->kriteria_id;
        });

        return view('admin.alternative_values.index', compact('alternatives', 'criterias', 'values'));
    }

    public function store(Request $request)
    {
        $data = $request->input('nilai');

        if (!$data) {
            return back()->with('error', 'Tidak ada data yang disimpan.');
        }

        foreach ($data as $alt_id => $criteria_values) {
            foreach ($criteria_values as $crit_id => $val) {
                AlternativeValue::updateOrCreate(
                    [
                        'alternatif_id' => $alt_id,
                        'kriteria_id' => $crit_id
                    ],
                    [
                        'nilai' => $val ?? 0
                    ]
                );
            }
        }

        return redirect()->route('admin.alternative-values.index')->with('success', 'Nilai alternatif berhasil disimpan.');
    }
}
