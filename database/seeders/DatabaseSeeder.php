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
            ['kriteria_id' => 2, 'nama' => 'Sempit (Contoh: < 3x3 m)', 'nilai' => 1],
            ['kriteria_id' => 2, 'nama' => 'Sedang (Contoh: 3x3 m - 4x4 m)', 'nilai' => 3],
            ['kriteria_id' => 2, 'nama' => 'Luas (Contoh: > 4x4 m)', 'nilai' => 5],
            
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

        // Alternatif Warna (150 Jotun Colors dari Excel JSON)
        $colorsJson = file_get_contents(database_path('seeders/colors_data.json'));
        $colorsData = json_decode($colorsJson, true);

        foreach ($colorsData as $color) {
            $altName = $color['name'];
            $altCode = (string)$color['code'];
            
            // local_image structure: "warna\Beige\1129 - Parchment.png"
            $filename = basename(str_replace('\\', '/', $color['local_image']));
            
            $alt = Alternative::create([
                'nama_warna' => $altName,
                'kode_warna' => $altCode,
                'kategori' => $color['kategori'],
                'deskripsi' => 'Warna cat interior Jotun varian ' . $altName . ' yang memberikan nuansa ' . strtolower($color['kategori']) . '.',
                'gambar_warna' => 'alternatives/' . $filename
            ]);
            
            // Nilai Kriteria dari JSON
            AlternativeValue::create(['alternatif_id' => $alt->id, 'kriteria_id' => 1, 'nilai' => $color['C1_FungsiRuangan'] ?? 3]);
            AlternativeValue::create(['alternatif_id' => $alt->id, 'kriteria_id' => 2, 'nilai' => $color['C2_LuasRuangan'] ?? 3]);
            AlternativeValue::create(['alternatif_id' => $alt->id, 'kriteria_id' => 3, 'nilai' => $color['C3_Pencahayaan'] ?? 3]);
            AlternativeValue::create(['alternatif_id' => $alt->id, 'kriteria_id' => 4, 'nilai' => $color['C4_NuansaMood'] ?? 3]);
        }

        // Matriks AHP dari CSV (Responden via Geometric Mean)
        $this->call(DatasetSeeder::class);
    }
}
