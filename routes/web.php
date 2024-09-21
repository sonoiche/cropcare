<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->to('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

require __DIR__ . '/admin-routes.php';
require __DIR__ . '/president-routes.php';
require __DIR__ . '/agriculture-routes.php';
