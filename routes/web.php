<?php

use App\Http\Controllers\ArchitectureController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProgramStudiController;
use Illuminate\Support\Facades\Route;

// halaman utama CampusInfo
Route::get('/', [HomeController::class, 'index'])->name('beranda');
Route::get('/program-studi', [ProgramStudiController::class, 'index'])->name('program-studi');
Route::get('/kontak', [ContactController::class, 'index'])->name('kontak');

// halaman analisis arsitektur (Architecture Explorer)
Route::prefix('architecture')->name('architecture.')->group(function () {
    Route::get('/', [ArchitectureController::class, 'dashboard'])->name('dashboard');
    Route::get('/request-lifecycle', [ArchitectureController::class, 'lifecycle'])->name('lifecycle');
    Route::get('/environment', [ArchitectureController::class, 'environment'])->name('environment');
});
