# 🎨 Sistem Pendukung Keputusan (SPK) Rekomendasi Warna Cat Interior Ruangan

[![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](LICENSE)

Aplikasi berbasis web untuk Sistem Pendukung Keputusan (**SPK**) dalam pemilihan rekomendasi warna cat interior ruangan rumah menggunakan kombinasi metode **Analytical Hierarchy Process (AHP)** dan **Technique for Order of Preference by Similarity to Ideal Solution (TOPSIS)** dengan pendekatan *Profile Matching*.

Studi kasus katalog warna cat menggunakan **150 varian warna interior Jotun** yang diklasifikasikan ke dalam berbagai nuansa dan karakteristik ruangan.

---

## 📌 Daftar Isi
- [Latar Belakang & Deskripsi](#-latar-belakang--deskripsi)
- [Metodologi Sistem](#-metodologi-sistem)
  - [1. Analytical Hierarchy Process (AHP)](#1-analytical-hierarchy-process-ahp)
  - [2. TOPSIS & Profile Matching](#2-topsis--profile-matching)
- [Kriteria & Sub-Kriteria](#-kriteria--sub-kriteria)
- [Fitur Utama](#-fitur-utama)
- [Teknologi yang Digunakan](#-teknologi-yang-digunakan)
- [Prasyarat Sistem](#-prasyarat-sistem)
- [Panduan Instalasi](#-panduan-instalasi)
- [Akun Pengguna Default](#-akun-pengguna-default)
- [Struktur Direktori Proyek](#-struktur-direktori-proyek)
- [Tangkapan Layar & Dokumentasi](#-tangkapan-layar--dokumentasi)
- [Lisensi](#-lisensi)

---

## 📖 Latar Belakang & Deskripsi

Pemilihan warna dinding interior memegang peranan krusial terhadap kenyamanan psikologis, estetika, serta persepsi spasial ruangan. Namun, masyarakat umum sering kali kesulitan menentukan perpaduan warna yang tepat karena terbatasnya pemahaman mengenai intensitas pencahayaan alami/buatan, dimensi ruang, fungsi ruangan, dan efek psikologi warna.

Sistem ini hadir untuk memberikan solusi objektif dan terukur dengan mengintegrasikan:
1. **AHP**: Digunakan oleh pakar/ahli interior untuk menentukan bobot prioritas relatif dari setiap kriteria perancangan interior, baik melalui input langsung matriks berpasangan maupun agregasi data kuesioner responden (*Geometric Mean* via upload CSV).
2. **TOPSIS**: Digunakan dalam memproses preferensi ruangan pengguna terhadap 150 alternatif warna cat Jotun. Pendekatan *Profile Matching (Gap Analysis)* diterapkan untuk mengukur seberapa dekat karakteristik warna cat dengan kebutuhan spesifik ruangan.

---

## 📐 Metodologi Sistem

```
+-------------------------------------------------------------+
|                     INPUT DATA RESEPONDEN                   |
|           Kuesioner Perbandingan Berpasangan (CSV)          |
+-------------------------------------------------------------+
                              │
                              ▼
+-------------------------------------------------------------+
|                 METODE AHP (BOBOT KRITERIA)                 |
|   1. Agregasi Responden: Geometric Mean                     |
|   2. Matriks Perbandingan Berpasangan                       |
|   3. Uji Konsistensi (Consistency Ratio: CR < 0.1)          |
|   => Menghasilkan Bobot Prioritas Kriteria (W)              |
+-------------------------------------------------------------+
                              │
                              ▼
+-------------------------------------------------------------+
|               INPUT PENGGUNA (PREFERENSI RUANG)             |
|   Fungsi Ruang, Luas Ruang, Pencahayaan, Nuansa & Kategori  |
+-------------------------------------------------------------+
                              │
                              ▼
+-------------------------------------------------------------+
|                METODE TOPSIS + PROFILE MATCHING             |
|   1. Perhitungan Selisih (GAP) = |Target - Baseline|        |
|   2. Pembentukan Matriks Keputusan (X) & Normalisasi (R)    |
|   3. Matriks Ternormalisasi Terbobot (Y = R * W)            |
|   4. Solusi Ideal Positif (A+) & Solusi Ideal Negatif (A-)  |
|   5. Jarak Euclidean (D+, D-) & Nilai Preferensi (V)        |
+-------------------------------------------------------------+
                              │
                              ▼
+-------------------------------------------------------------+
|                     HASIL REKOMENDASI                       |
|          Perangkingan Top 10 Warna Interior Jotun           |
+-------------------------------------------------------------+
```

### 1. Analytical Hierarchy Process (AHP)
- Memetakan tingkat kepentingan relatif antar-kriteria ($n=4$).
- Dilengkapi fitur agregasi kuesioner pakar secara otomatis menggunakan metode **Rata-Rata Geometrik (*Geometric Mean*)** dari berkas CSV.
- Menghitung **Eigen Vector**, **$\lambda_{max}$**, **Consistency Index (CI)**, dan **Consistency Ratio (CR)** guna menjamin konsistensi penilaian ($CR \le 0.1$).

### 2. TOPSIS & Profile Matching
- **Kalkulasi GAP**: Menghitung selisih antara kriteria ideal yang diinginkan pengguna dengan profil warna cat pada database:
  $$\text{Skor} = 5 - |\text{Target} - \text{Baseline}|$$
- **Normalisasi Matriks Keputusan**:
  $$r_{ij} = \frac{x_{ij}}{\sqrt{\sum_{k=1}^m x_{kj}^2}}$$
- **Normalisasi Terbobot**: Mengalikan matriks ternormalisasi dengan bobot prioritas kriteria ($W$) hasil AHP:
  $$y_{ij} = w_j \cdot r_{ij}$$
- **Jarak Solusi Ideal & Preferensi**:
  $$V_i = \frac{D_i^-}{D_i^+ + D_i^-}$$
- Hasil diurutkan berdasarkan nilai preferensi tertinggi ($V_i \to 1$).

---

## 📊 Kriteria & Sub-Kriteria

Sistem menggunakan 4 kriteria utama dalam evaluasi warna interior:

| Kode | Kriteria | Tipe | Deskripsi Singkat | Skala Sub-Kriteria |
| :---: | :--- | :---: | :--- | :--- |
| **C1** | **Fungsi Ruangan** | *Benefit* | Peruntukan ruangan dan aktivitas di dalamnya | Ruang Tamu (5), Kamar Tidur (4), Ruang Kerja (3), Ruang Makan (2), Kamar Mandi (1) |
| **C2** | **Luas Ruangan** | *Benefit* | Dimensi ukuran ruangan | Luas > 4x4 m (5), Sedang 3x3–4x4 m (3), Sempit < 3x3 m (1) |
| **C3** | **Pencahayaan** | *Benefit* | Tingkat intensitas lux cahaya alami / buatan | Tinggi > 300 lux (5), Sedang 150–300 lux (3), Rendah < 150 lux (1) |
| **C4** | **Nuansa / Mood** | *Benefit* | Suasana psikologis yang ingin dibangun | Modern (5), Elegan (4), Ceria (3), Hangat (2), Tenang (1) |

---

## ✨ Fitur Utama

### 👤 Modul Pengguna (User / Publik)
- **Beranda Interaktif**: Pengenalan konsep psikologi warna dan panduan pemilihan warna interior.
- **Form Konsultasi & Rekomendasi**:
  - Pilihan fungsi ruang, luas ruangan, dan kondisi pencahayaan.
  - Pilihan nuansa / mood suasana yang diinginkan.
  - Filter opsional rumpun warna (Beige, Blue, Green, Grey, Neutral, Red, Yellow, White, dll).
- **Hasil Rekomendasi Detail**:
  - Tampilan Top 10 warna Jotun dengan skor preferensi tertinggi.
  - Informasi nama warna, kode warna resmi Jotun, swatch warna, serta visualisasi ruangan.
  - Nilai preferensi ($V$) beserta deskripsi kecocokan suasana.
- **Riwayat Konsultasi**: Tersimpan untuk pelacakan keputusan pengguna.

### 🔐 Modul Administrator
- **Dashboard Analitik**: Ringkasan jumlah kriteria, sub-kriteria, alternatif warna cat, dan riwayat rekomendasi.
- **Manajemen Kriteria & Sub-Kriteria**: Operasi CRUD dinamis untuk penyesuaian kriteria dan pembobotan sub-kriteria.
- **Katalog 150 Alternatif Warna Jotun**: CRUD data warna cat lengkap dengan kode warna, kategori, deskripsi, dan upload gambar swatch.
- **Matriks Nilai Alternatif**: Pengaturan bobot baseline setiap alternatif terhadap seluruh kriteria.
- **Kalkulasi & Matriks AHP**:
  - Matriks perbandingan berpasangan interaktif.
  - **Upload CSV Kuesioner Responden**: Menghitung *Geometric Mean* otomatis dari multi-responden kuesioner.
  - Pengecekan otomatis nilai $\lambda_{max}$, CI, dan rasio konsistensi (CR).

---

## 🛠️ Teknologi yang Digunakan

- **Backend Framework**: [Laravel 11](https://laravel.com/) (PHP 8.2+)
- **Database**: [MySQL](https://www.mysql.com/) / MariaDB
- **Frontend / UI**: Blade Templating, [Bootstrap 5.3](https://getbootstrap.com/), [Bootstrap Icons](https://icons.getbootstrap.com/)
- **Typography**: Google Fonts (*Inter*)
- **Environment**: Laragon / XAMPP / Apache

---

## 💻 Prasyarat Sistem

Sebelum menjalankan aplikasi, pastikan perangkat Anda telah terpasang:
- **PHP** versi `>= 8.2`
- **Composer** versi `>= 2.x`
- **MySQL** / **MariaDB**
- **Web Server** (Apache / Nginx / Laragon / PHP built-in server)
- **Git**

Ekstensi PHP yang direkomendasikan aktif:
- `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`, `gd`

---

## 🚀 Panduan Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek di komputer lokal:

### 1. Kloning Repositori
```bash
git clone https://github.com/bagus2719/sistem-rekomendasi-cat-rumah.git
cd sistem-rekomendasi-cat-rumah
```

### 2. Pasang Dependensi Composer
```bash
composer install
```

### 3. Konfigurasi Environment (`.env`)
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```
Buka file `.env` dan sesuaikan kredensial database Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=spk_interior
DB_USERNAME=root
DB_PASSWORD=
```
> **Catatan**: Pastikan database dengan nama `spk_interior` sudah dibuat di MySQL/phpMyAdmin Anda.

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Jalankan Migrasi & Database Seeder
Perintah ini akan membuat struktur tabel dan mengisi data awal (150 warna Jotun, kriteria, sub-kriteria, akun default, dan nilai matriks AHP):
```bash
php artisan migrate --seed
```

### 6. Buat Symbolic Link Storage
Pastikan gambar alternatif warna cat dapat diakses oleh browser:
```bash
php artisan storage:link
```

### 7. Jalankan Server Lokal
```bash
php artisan serve
```
Aplikasi dapat diakses melalui browser di alamat:
👉 **`http://127.0.0.1:8000`** atau melalui Laragon **`http://spk-interior.test`**

---

## 🔑 Akun Pengguna Default

Database seeder secara otomatis menyediakan 2 jenis akun:

| Role | Email | Password | Hak Akses |
| :--- | :--- | :--- | :--- |
| **Administrator** | `admin@gmail.com` | `password` | Mengelola Kriteria, Sub-kriteria, 150 Alternatif Warna, Nilai Matriks, dan Perhitungan AHP |
| **User Biasa** | `user@gmail.com` | `password` | Mengakses konsultasi rekomendasi dan melihat riwayat |

---

## 📁 Struktur Direktori Proyek

```plaintext
spk-interior/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Admin/              # Controller CRUD Admin (Ahp, Alternative, Criteria, dll)
│   │       ├── AuthController.php  # Autentikasi Pengguna & Admin
│   │       ├── HomeController.php  # Halaman Beranda Publik
│   │       └── RecommendationController.php # Logika Permintaan Rekomendasi
│   ├── Models/                     # Eloquent Model (Criteria, Alternative, History, dll)
│   └── Services/
│       ├── AhpService.php          # Logika Perhitungan AHP & Geometric Mean
│       └── TopsisService.php       # Logika Perhitungan TOPSIS & Profile Matching
├── database/
│   ├── migrations/                 # Skema Database Migrations
│   └── seeders/
│       ├── DatabaseSeeder.php      # Seeder Utama (Kriteria, Sub-Kriteria, Admin)
│       ├── DatasetSeeder.php       # Seeder Perhitungan AHP dari CSV
│       └── colors_data.json        # Dataset 150 Varian Warna Interior Jotun
├── perancangan/                    # Diagram Perancangan Sistem (DFD, Flowchart, Use Case)
├── resources/
│   └── views/
│       ├── admin/                  # Tampilan Halaman Dashboard & Kelola Data Admin
│       ├── auth/                   # Tampilan Form Login
│       ├── layouts/                # Template Layout Utama
│       └── recommendation/         # Tampilan Form & Hasil Rekomendasi
├── routes/
│   └── web.php                     # Definisi Rute Aplikasi
└── storage/
    └── app/
        ├── ahp_dataset.csv         # Dataset Kuesioner Responden AHP
        └── public/alternatives/    # Direktori Gambar & Swatch Warna
```

---

## 📝 Format CSV untuk Kuesioner AHP

Jika Anda ingin memperbarui bobot kriteria menggunakan data kuesioner baru pada menu **Admin > Perhitungan AHP > Upload CSV**:
- File berformat `.csv`.
- Baris pertama berisi header kolom.
- Nilai perbandingan diisi pada kolom terakhir sebanyak $\frac{n(n-1)}{2} = 6$ kombinasi perbandingan berpasangan (C1 vs C2, C1 vs C3, C1 vs C4, C2 vs C3, C2 vs C4, C3 vs C4).
- Nilai dapat berupa angka bulat (contoh: `3`, `5`) maupun pecahan (contoh: `1/3`, `1/5`).

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah lisensi [MIT License](LICENSE). Bebas digunakan, dimodifikasi, dan didistribusikan untuk keperluan akademik maupun pengembangan lebih lanjut.

---

<p align="center">
  Dibuat dengan ❤️ untuk kemudahan pemilihan interior hunian yang harmonis dan estetik.
</p>
