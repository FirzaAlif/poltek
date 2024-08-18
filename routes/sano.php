<?php

use App\Http\Controllers\DepartementController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('departements', DepartementController::class);
});
