<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CriteriaController;
use App\Http\Controllers\Admin\AlternativeController;
use App\Http\Controllers\Admin\AlternativeValueController;
use App\Http\Controllers\Admin\AhpController;
use App\Http\Controllers\Admin\SubKriteriaController;

// User Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/rekomendasi', [RecommendationController::class, 'form'])->name('recommendation.form');
Route::post('/rekomendasi', [RecommendationController::class, 'process'])->name('recommendation.process');
Route::get('/rekomendasi/hasil', [RecommendationController::class, 'result'])->name('recommendation.result');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Kriteria
    Route::resource('criterias', CriteriaController::class);
    
    // Alternatif Warna
    Route::resource('alternatives', AlternativeController::class);
    
    // Nilai Alternatif
    Route::get('alternative-values', [AlternativeValueController::class, 'index'])->name('alternative-values.index');
    Route::post('alternative-values', [AlternativeValueController::class, 'store'])->name('alternative-values.store');
    
    // AHP Route
    Route::get('/ahp', [AhpController::class, 'index'])->name('ahp.index');
    Route::post('/ahp/calculate', [AhpController::class, 'calculate'])->name('ahp.calculate');
    Route::post('/ahp/upload-csv', [AhpController::class, 'uploadCsv'])->name('ahp.uploadCsv');

    // Manajemen Sub Kriteria
    Route::resource('sub-kriteria', SubKriteriaController::class)->parameters([
        'sub-kriteria' => 'subKriterium'
    ]);
});
