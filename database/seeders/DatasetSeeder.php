<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Criteria;
use App\Models\AhpComparison;
use Illuminate\Support\Facades\Storage;

class DatasetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = storage_path('app/ahp_dataset.csv');
        
        if (!file_exists($filePath)) {
            $this->command->warn('ahp_dataset.csv not found in storage/app/. Skipping DatasetSeeder.');
            return;
        }

        $csvData = file_get_contents($filePath);
        // We will call AhpService
        try {
            $ahpService = new \App\Services\AhpService();
            $result = $ahpService->calculateGeometricMeanFromCsv($csvData);
            $simulatedInput = $result['matrixInput'];
            $numRespondents = $result['numRespondents'];
        } catch (\Exception $e) {
            $this->command->error($e->getMessage());
            return;
        }

        $criterias = Criteria::orderBy('id', 'asc')->get();
        $cIds = $criterias->pluck('id')->toArray();
        $n = $criterias->count();
        
        AhpComparison::truncate(); // Bersihkan yang lama

        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                $c1Id = $cIds[$i];
                $c2Id = $cIds[$j];

                if ($i == $j) {
                    $val = 1;
                } elseif ($i < $j) {
                    $val = floatval($simulatedInput[$c1Id][$c2Id] ?? 1);
                } else {
                    $val = 1 / floatval($simulatedInput[$c2Id][$c1Id] ?? 1);
                }

                AhpComparison::create([
                    'kriteria_1_id' => $c1Id,
                    'kriteria_2_id' => $c2Id,
                    'nilai' => $val
                ]);
            }
        }

        // Jalankan kalkulasi AHP standar untuk menyetel bobot akhir
        $ahpService->calculateWeights();
        
        $this->command->info("DatasetSeeder: Berhasil menghitung Geometric Mean dari {$numRespondents} responden dan menyimpan bobot akhir melalui AhpService.");
    }
}
