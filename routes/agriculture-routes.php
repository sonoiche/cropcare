<?php

use App\Http\Controllers\Agriculturist\ConsultationController;
use App\Http\Controllers\Agriculturist\GeographicController;
use Illuminate\Support\Facades\Route;

Route::prefix('agriculturist')->middleware(['auth:web'])->group(function () {
    Route::resource('consultations', ConsultationController::class);
    Route::resource('geographics', GeographicController::class);
});
