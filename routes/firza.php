<?php

use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function () {
    Route::resource('mahasiswas', MahasiswaController::class);
});
?>
