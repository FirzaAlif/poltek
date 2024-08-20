<?php

use App\Http\Controllers\TasktransactionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('tasktransactions', TasktransactionController::class);
});








?>
