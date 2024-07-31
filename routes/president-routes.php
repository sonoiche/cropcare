<?php

use App\Http\Controllers\President\FarmerController;
use Illuminate\Support\Facades\Route;

Route::prefix('president')->middleware(['auth:web'])->group( function () {
    Route::resource('farmers', FarmerController::class);
});