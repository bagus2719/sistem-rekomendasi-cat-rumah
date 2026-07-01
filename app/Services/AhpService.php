<?php

namespace App\Services;

use App\Models\Criteria;
use App\Models\AhpComparison;

class AhpService
{
    public function calculateGeometricMeanFromCsv($csvData)
    {
        $rows = array_map('str_getcsv', explode("\n", trim($csvData)));
        // Hapus header
        array_shift($rows);

        $criterias = Criteria::orderBy('id', 'asc')->get();
        $n = $criterias->count();
        if ($n < 3) {
            throw new \Exception('Data Kriteria harus berjumlah minimal 3.');
        }

        $expectedColumns = ($n * ($n - 1)) / 2; // Kombinasi 2 dari n
        $numRespondents = 0;
        $geoMeans = array_fill(0, $expectedColumns, 0); // stores sum of logs
        
        foreach ($rows as $row) {
            // Selalu ambil dari kolom terakhir sebanyak $expectedColumns (mengabaikan kolom Responden, Nama, dll di awal)
            $comparisons = array_slice($row, -$expectedColumns);
            
            if (count($comparisons) < $expectedColumns) continue;
            
            $numRespondents++;
            for ($i = 0; $i < $expectedColumns; $i++) {
                $rawVal = trim($comparisons[$i]);
                
                // Cek jika user mengetik pecahan (misal '1/3')
                if (strpos($rawVal, '/') !== false) {
                    $parts = explode('/', $rawVal);
                    $val = (floatval($parts[1]) != 0) ? floatval($parts[0]) / floatval($parts[1]) : 1;
                } else {
                    $val = floatval($rawVal);
                }

                if ($val > 0) {
                    $geoMeans[$i] += log($val);
                }
            }
        }

        if ($numRespondents == 0) {
            throw new \Exception("Data CSV kosong atau jumlah kolom kurang dari {$expectedColumns}. Pastikan file CSV Anda memiliki {$expectedColumns} kolom jawaban.");
        }

        for ($i = 0; $i < $expectedColumns; $i++) {
            $geoMeans[$i] = exp($geoMeans[$i] / $numRespondents);
        }

        $cIds = $criterias->pluck('id')->toArray();
        $simulatedInput = [];
        
        // Pemetaan dinamis
        $k = 0;
        for ($i = 0; $i < $n; $i++) {
            for ($j = $i + 1; $j < $n; $j++) {
                $simulatedInput[$cIds[$i]][$cIds[$j]] = $geoMeans[$k] ?? 1;
                $k++;
            }
        }

        return [
            'numRespondents' => $numRespondents,
            'matrixInput' => $simulatedInput
        ];
    }

    public function calculateWeights()
    {
        $criterias = Criteria::orderBy('id', 'asc')->get();
        $n = $criterias->count();
        if ($n == 0) return [];

        $matrix = [];
        $savedComparisons = AhpComparison::all()->keyBy(function($item) {
            return $item->kriteria_1_id . '-' . $item->kriteria_2_id;
        });

        for ($i = 0; $i < $n; $i++) {
            $c1 = $criterias[$i];
            for ($j = 0; $j < $n; $j++) {
                $c2 = $criterias[$j];
                if ($i == $j) {
                    $val = 1;
                } elseif ($i < $j) {
                    $key = $c1->id . '-' . $c2->id;
                    $val = isset($savedComparisons[$key]) ? $savedComparisons[$key]->nilai : 1;
                } else {
                    $key = $c2->id . '-' . $c1->id;
                    $val = isset($savedComparisons[$key]) ? 1 / $savedComparisons[$key]->nilai : 1;
                }
                $matrix[$i][$j] = $val;
            }
        }

        $colSums = array_fill(0, $n, 0);
        for ($j = 0; $j < $n; $j++) {
            for ($i = 0; $i < $n; $i++) {
                $colSums[$j] += $matrix[$i][$j];
            }
        }

        $normalizedMatrix = [];
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                $normalizedMatrix[$i][$j] = $matrix[$i][$j] / $colSums[$j];
            }
        }

        $weights = [];
        for ($i = 0; $i < $n; $i++) {
            $sum = 0;
            for ($j = 0; $j < $n; $j++) {
                $sum += $normalizedMatrix[$i][$j];
            }
            $weights[$i] = $sum / $n;
            
            $c = $criterias[$i];
            $c->bobot = $weights[$i];
            $c->save();
        }

        $lambdaMax = 0;
        for ($j = 0; $j < $n; $j++) {
            $lambdaMax += $colSums[$j] * $weights[$j];
        }

        $ci = ($lambdaMax - $n) / ($n - 1);
        $riTable = [0, 0, 0, 0.58, 0.90, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49];
        $ri = $riTable[$n] ?? 1.49;
        $cr = $ri > 0 ? $ci / $ri : 0;

        return [
            'matrix' => $matrix,
            'normalizedMatrix' => $normalizedMatrix,
            'weights' => $weights,
            'criterias' => $criterias,
            'colSums' => $colSums,
            'lambdaMax' => $lambdaMax,
            'ci' => $ci,
            'cr' => $cr,
            'is_consistent' => $cr <= 0.1
        ];
    }
}
