<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Criteria;
use App\Models\AhpComparison;
use Illuminate\Http\Request;
use App\Services\AhpService;

class AhpController extends Controller
{
    protected $ahpService;

    public function __construct(AhpService $ahpService)
    {
        $this->ahpService = $ahpService;
    }

    public function index()
    {
        $criterias = Criteria::orderBy('id', 'asc')->get();
        
        if ($criterias->count() < 2) {
            return redirect()->route('admin.dashboard')->with('error', 'Minimal 2 kriteria untuk perhitungan AHP.');
        }

        // Fetch saved comparisons if any
        $savedComparisons = AhpComparison::all()->keyBy(function($item) {
            return $item->kriteria_1_id . '-' . $item->kriteria_2_id;
        });

        // Initialize matrix
        $matrix = [];
        foreach ($criterias as $c1) {
            foreach ($criterias as $c2) {
                if ($c1->id == $c2->id) {
                    $matrix[$c1->id][$c2->id] = 1;
                } else {
                    $key = $c1->id . '-' . $c2->id;
                    $matrix[$c1->id][$c2->id] = isset($savedComparisons[$key]) ? $savedComparisons[$key]->nilai : 1;
                }
            }
        }

        // Generate matrix, weights, CR if user requests result
        $results = null;
        if (session()->has('ahp_results')) {
            $results = session('ahp_results');
        }

        return view('admin.ahp.index', compact('criterias', 'matrix', 'results'));
    }

    public function calculate(Request $request)
    {
        $criterias = Criteria::orderBy('id', 'asc')->get();
        $n = $criterias->count();
        $inputs = $request->input('matrix', []);

        AhpComparison::truncate(); // Clear old data

        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                $c1 = $criterias[$i];
                $c2 = $criterias[$j];

                if ($i == $j) {
                    $val = 1;
                } elseif ($i < $j) {
                    // Get from input
                    $val = floatval($inputs[$c1->id][$c2->id] ?? 1);
                } else {
                    // Inverse of upper triangle
                    $val = 1 / floatval($inputs[$c2->id][$c1->id] ?? 1);
                }

                AhpComparison::create([
                    'kriteria_1_id' => $c1->id,
                    'kriteria_2_id' => $c2->id,
                    'nilai' => $val
                ]);
            }
        }

        $results = $this->ahpService->calculateWeights();

        if (empty($results)) {
            return redirect()->route('admin.ahp.index')->with('error', 'Belum ada data kriteria.');
        }
        
        $results['criterias'] = $criterias->pluck('nama')->toArray();
        $results['kodes'] = $criterias->pluck('kode')->toArray();
        // Rename normMatrix since view expects it
        $results['normMatrix'] = $results['normalizedMatrix'];
        return redirect()->route('admin.ahp.index')->with('ahp_results', $results)->with('success', 'Matriks AHP berhasil dihitung dan bobot kriteria telah diperbarui.');
    }

    public function uploadCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt'
        ]);

        $file = $request->file('csv_file');
        $csvData = file_get_contents($file);

        try {
            $ahpService = new \App\Services\AhpService();
            $result = $ahpService->calculateGeometricMeanFromCsv($csvData);
            $simulatedInput = $result['matrixInput'];
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        $newRequest = new Request();
        $newRequest->replace(['matrix' => $simulatedInput]);
        
        return $this->calculate($newRequest);
    }
}
