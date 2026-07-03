<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Criteria;
use App\Models\Alternative;
use App\Models\AlternativeValue;
use App\Models\AhpComparison;
use App\Models\SubKriteria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin default
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // User default
        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Kriteria default (4 Kriteria)
        $criterias = [
            ['kode' => 'C1', 'nama' => 'Fungsi Ruangan', 'tipe' => 'benefit', 'bobot' => 0.15],
            ['kode' => 'C2', 'nama' => 'Luas Ruangan', 'tipe' => 'benefit', 'bobot' => 0.25],
            ['kode' => 'C3', 'nama' => 'Pencahayaan', 'tipe' => 'benefit', 'bobot' => 0.25],
            ['kode' => 'C4', 'nama' => 'Nuansa / Mood', 'tipe' => 'benefit', 'bobot' => 0.35],
        ];

        foreach ($criterias as $criteria) {
            Criteria::create($criteria);
        }

        // Sub Kriteria
        $subKriterias = [
            // C1: Fungsi Ruangan
            ['kriteria_id' => 1, 'nama' => 'Ruang Tamu', 'nilai' => 5],
            ['kriteria_id' => 1, 'nama' => 'Kamar Tidur', 'nilai' => 4],
            ['kriteria_id' => 1, 'nama' => 'Ruang Kerja', 'nilai' => 3],
            ['kriteria_id' => 1, 'nama' => 'Ruang Makan', 'nilai' => 2],
            ['kriteria_id' => 1, 'nama' => 'Kamar Mandi', 'nilai' => 1],
            
            // C2: Luas Ruangan
            ['kriteria_id' => 2, 'nama' => 'Sempit (< 9 m²)', 'nilai' => 1],
            ['kriteria_id' => 2, 'nama' => 'Sedang (9 - 16 m²)', 'nilai' => 3],
            ['kriteria_id' => 2, 'nama' => 'Luas (> 16 m²)', 'nilai' => 5],
            
            // C3: Pencahayaan
            ['kriteria_id' => 3, 'nama' => 'Rendah (< 150 lux)', 'nilai' => 1],
            ['kriteria_id' => 3, 'nama' => 'Sedang (150 - 300 lux)', 'nilai' => 3],
            ['kriteria_id' => 3, 'nama' => 'Tinggi (> 300 lux)', 'nilai' => 5],
            
            // C4: Nuansa/Mood Pengguna
            ['kriteria_id' => 4, 'nama' => 'Tenang', 'nilai' => 1],
            ['kriteria_id' => 4, 'nama' => 'Hangat', 'nilai' => 2],
            ['kriteria_id' => 4, 'nama' => 'Ceria', 'nilai' => 3],
            ['kriteria_id' => 4, 'nama' => 'Elegan', 'nilai' => 4],
            ['kriteria_id' => 4, 'nama' => 'Modern', 'nilai' => 5],
        ];

        foreach ($subKriterias as $sub) {
            SubKriteria::create($sub);
        }

        // Alternatif Warna
        $alternatives = [
            ['nama_warna' => 'Jotun Egg White', 'kode_warna' => '1001', 'deskripsi' => 'Memberi kesan bersih, luas, dan netral.'],
            ['nama_warna' => 'Jotun Sun', 'kode_warna' => '10428', 'deskripsi' => 'Ceria dan penuh energi, cocok untuk mencerahkan ruangan.'],
            ['nama_warna' => 'Jotun Green Harmony', 'kode_warna' => '8252', 'deskripsi' => 'Membawa nuansa alam yang menenangkan ke dalam ruangan.'],
            ['nama_warna' => 'Jotun Sea Emerald', 'kode_warna' => '6084', 'deskripsi' => 'Sangat menenangkan, ideal untuk ruang istirahat.'],
            ['nama_warna' => 'Jotun Matrix', 'kode_warna' => '9913', 'deskripsi' => 'Modern dan elegan, netral tapi tidak membosankan.'],
        ];

        $altModels = [];
        foreach ($alternatives as $alt) {
            $altModels[] = Alternative::create($alt);
        }

        // Matriks AHP dari CSV (40 Responden via Geometric Mean)
        $this->call(DatasetSeeder::class);

        // Nilai Alternatif (Karakteristik Warna 1-5)
        // C1 (Fungsi Ruangan)
        // C2 (Luas)
        // C3 (Pencahayaan)
        // C4 (Nuansa/Mood)
        
        $altValues = [
            // Jotun Egg White
            1 => [3, 4, 3, 4],
            // Jotun Sun
            2 => [3, 3, 3, 3],
            // Jotun Green Harmony
            3 => [3, 3, 4, 1],
            // Jotun Sea Emerald
            4 => [4, 4, 3, 1],
            // Jotun Matrix
            5 => [3, 4, 3, 5],
        ];

        foreach ($altValues as $altId => $values) {
            foreach ($values as $critIndex => $val) {
                AlternativeValue::create([
                    'alternatif_id' => $altId,
                    'kriteria_id' => $critIndex + 1,
                    'nilai' => $val
                ]);
            }
        }
    }
}
