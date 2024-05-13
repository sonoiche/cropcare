<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth:web'])->group( function () {
    Route::resource('users', UserController::class);
});