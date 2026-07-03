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

        // Alternatif Warna (Berdasarkan File Excel)
        $alternatives = [
            ['nama_warna' => 'A1 Unbleached', 'kode_warna' => 'A1', 'deskripsi' => 'Warna cat interior Jotun Majestic.'],
            ['nama_warna' => 'A2 Soft Radiance', 'kode_warna' => 'A2', 'deskripsi' => 'Warna cat interior Jotun Majestic.'],
            ['nama_warna' => 'A3 Iconic', 'kode_warna' => 'A3', 'deskripsi' => 'Warna cat interior Jotun Majestic.'],
            ['nama_warna' => 'A4 Soft Dunes', 'kode_warna' => 'A4', 'deskripsi' => 'Warna cat interior Jotun Majestic.'],
            ['nama_warna' => 'A5 Green Tea', 'kode_warna' => 'A5', 'deskripsi' => 'Warna cat interior Jotun Majestic.'],
            ['nama_warna' => 'A6 Northern Mystic', 'kode_warna' => 'A6', 'deskripsi' => 'Warna cat interior Jotun Majestic.'],
            ['nama_warna' => 'A7 Pink Ambience', 'kode_warna' => 'A7', 'deskripsi' => 'Warna cat interior Jotun Majestic.'],
            ['nama_warna' => 'A8 Olive', 'kode_warna' => 'A8', 'deskripsi' => 'Warna cat interior Jotun Majestic.'],
        ];

        $altModels = [];
        foreach ($alternatives as $alt) {
            $altModels[] = Alternative::create($alt);
        }

        // Matriks AHP dari CSV (Responden via Geometric Mean)
        $this->call(DatasetSeeder::class);

        // Nilai Alternatif (Karakteristik Warna 1-5 berdasarkan Excel TOPS)
        // Array format: [C1, C2, C3, C4]
        $altValues = [
            1 => [5, 5, 5, 4], // A1 Unbleached
            2 => [5, 5, 5, 5], // A2 Soft Radiance
            3 => [4, 4, 4, 5], // A3 Iconic
            4 => [5, 4, 4, 5], // A4 Soft Dunes
            5 => [4, 4, 4, 5], // A5 Green Tea
            6 => [3, 2, 2, 5], // A6 Northern Mystic
            7 => [4, 4, 4, 5], // A7 Pink Ambience
            8 => [4, 3, 3, 5], // A8 Olive
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
