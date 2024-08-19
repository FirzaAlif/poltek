<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MajorController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function () {
    Route::resource('mahasiswas', MahasiswaController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('majors', MajorController::class);
});
?>
