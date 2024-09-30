<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\PresensiController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function () {
    Route::resource('mahasiswas', MahasiswaController::class);
});

Route::middleware(['auth', 'role:super_admin|admin'])->group(function () {
    Route::resource('majors', MajorController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('assignments', AssignmentController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/presensi', [PresensiController::class, 'index'])->name('presensi.index');
    Route::post('/presensi/fetch', [PresensiController::class, 'fetchPresensi'])->name('presensi.fetch');
    Route::post('/presensi/store', [PresensiController::class, 'store'])->name('presensi.store');
});



?>  
