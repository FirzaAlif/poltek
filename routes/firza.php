<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MajorController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth','role|super_admin|admin'])->group(function () {
    Route::resource('mahasiswas', MahasiswaController::class);
});

Route::middleware(['auth', 'role:super_admin|admin'])->group(function () {
    Route::resource('majors', MajorController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('assignments', AssignmentController::class);
});
?>
