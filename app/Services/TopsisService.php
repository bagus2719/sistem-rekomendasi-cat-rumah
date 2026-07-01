<?php

namespace App\Services;

use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\AlternativeValue;

class TopsisService
{
    public function calculate($targets)
    {
        $criterias = Criteria::orderBy('id', 'asc')->get();
        $alternatives = Alternative::all();

        if ($criterias->isEmpty() || $alternatives->isEmpty()) {
            return null;
        }

        // 1. Matriks Keputusan (X) dengan Profile Matching (Gap)
        $matrix = [];
        foreach ($alternatives as $alt) {
            foreach ($criterias as $crit) {
                // Ambil nilai baseline
                $baseline = AlternativeValue::where('alternatif_id', $alt->id)
                                       ->where('kriteria_id', $crit->id)
                                       ->value('nilai') ?? 3;
                
                // Menghitung Gap
                $targetValue = $targets[$crit->kode] ?? 3;
                $gap = abs($targetValue - $baseline);
                
                // Konversi Gap ke Skor (Semakin kecil gap, skor semakin tinggi)
                $val = 5 - $gap;
                $matrix[$alt->id][$crit->id] = $val;
            }
        }

        // 2. Matriks Keputusan Ternormalisasi (R)
        $divisors = [];
        foreach ($criterias as $crit) {
            $sumSq = 0;
            foreach ($alternatives as $alt) {
                $sumSq += pow($matrix[$alt->id][$crit->id], 2);
            }
            $divisors[$crit->id] = sqrt($sumSq);
        }

        $normalizedMatrix = [];
        foreach ($alternatives as $alt) {
            foreach ($criterias as $crit) {
                $div = $divisors[$crit->id];
                $normalizedMatrix[$alt->id][$crit->id] = $div == 0 ? 0 : $matrix[$alt->id][$crit->id] / $div;
            }
        }

        // 3. Matriks Keputusan Ternormalisasi Terbobot (V)
        $weightedMatrix = [];
        foreach ($alternatives as $alt) {
            foreach ($criterias as $crit) {
                $weightedMatrix[$alt->id][$crit->id] = $normalizedMatrix[$alt->id][$crit->id] * $crit->bobot;
            }
        }

        // 4. Solusi Ideal Positif (A+) dan Negatif (A-)
        $idealPositive = [];
        $idealNegative = [];

        foreach ($criterias as $crit) {
            $vals = array_column($weightedMatrix, $crit->id);
            if ($crit->tipe == 'benefit') {
                $idealPositive[$crit->id] = max($vals);
                $idealNegative[$crit->id] = min($vals);
            } else {
                $idealPositive[$crit->id] = min($vals);
                $idealNegative[$crit->id] = max($vals);
            }
        }

        // 5. Jarak Solusi Ideal
        $dPlus = [];
        $dMinus = [];
        foreach ($alternatives as $alt) {
            $sumPlus = 0;
            $sumMinus = 0;
            foreach ($criterias as $crit) {
                $sumPlus += pow($weightedMatrix[$alt->id][$crit->id] - $idealPositive[$crit->id], 2);
                $sumMinus += pow($weightedMatrix[$alt->id][$crit->id] - $idealNegative[$crit->id], 2);
            }
            $dPlus[$alt->id] = sqrt($sumPlus);
            $dMinus[$alt->id] = sqrt($sumMinus);
        }

        // 6. Nilai Preferensi (V)
        $preferences = [];
        foreach ($alternatives as $alt) {
            $den = $dPlus[$alt->id] + $dMinus[$alt->id];
            $preferences[$alt->id] = $den == 0 ? 0 : $dMinus[$alt->id] / $den;
        }

        // Urutkan alternatif berdasarkan preferensi tertinggi
        $ranked = $alternatives->map(function ($alt) use ($preferences) {
            $alt->score = $preferences[$alt->id];
            return $alt;
        })->sortByDesc('score')->values();

        return [
            'matrix' => $matrix,
            'normalizedMatrix' => $normalizedMatrix,
            'weightedMatrix' => $weightedMatrix,
            'idealPositive' => $idealPositive,
            'idealNegative' => $idealNegative,
            'dPlus' => $dPlus,
            'dMinus' => $dMinus,
            'preferences' => $preferences,
            'ranked' => $ranked,
            'criterias' => $criterias,
        ];
    }
}
