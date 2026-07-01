<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\History;
use App\Services\TopsisService;

class RecommendationController extends Controller
{
    protected $topsisService;

    public function __construct(TopsisService $topsisService)
    {
        $this->topsisService = $topsisService;
    }

    public function form()
    {
        // Load criteria with their dynamic sub-criteria
        $criterias = Criteria::with('subKriteria')->orderBy('id', 'asc')->get();
        return view('recommendation.form', compact('criterias'));
    }

    public function process(Request $request)
    {
        $inputs = $request->except('_token');
        $criterias = Criteria::orderBy('id', 'asc')->get();

        if ($criterias->isEmpty()) {
            return back()->with('error', 'Data kriteria belum lengkap.');
        }

        // Karena form menggunakan subKriteria dinamis, input value sudah berupa bobot nilai 1-5.
        // Kita petakan input ke array target untuk TopsisService.
        $targets = [];
        foreach ($criterias as $crit) {
            $key = 'c' . $crit->id;
            // Gunakan nilai dari input user, atau default 3
            $targets[$crit->kode] = floatval($inputs[$key] ?? 3);
        }

        // Lakukan perhitungan TOPSIS
        $result = $this->topsisService->calculate($targets);

        if (!$result) {
            return back()->with('error', 'Gagal memproses rekomendasi. Pastikan data alternatif dan kriteria tersedia.');
        }

        $rankings = [];
        foreach ($result['ranked'] as $alt) {
            $rankings[] = [
                'alternative' => $alt,
                'score' => $alt->score
            ];
        }

        // Simpan ke Riwayat
        History::create([
            'input_data' => $inputs,
            'hasil_rekomendasi' => array_map(function($r) {
                return [
                    'nama' => $r['alternative']->nama_warna,
                    'score' => $r['score']
                ];
            }, $rankings)
        ]);

        return redirect()->route('recommendation.result')->with([
            'rankings' => $rankings,
            'best_alternative' => count($rankings) > 0 ? $rankings[0]['alternative'] : null,
            'best_score' => count($rankings) > 0 ? $rankings[0]['score'] : 0,
        ]);
    }

    public function result()
    {
        if (!session()->has('rankings')) {
            return redirect()->route('recommendation.form');
        }

        return view('recommendation.result', [
            'rankings' => session('rankings'),
            'best_alternative' => session('best_alternative'),
            'best_score' => session('best_score'),
        ]);
    }
}
