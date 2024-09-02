<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/login', [ AuthController::class, 'login'])->name('login');

Route::middleware('auth')->group(function () {
  Route::get('/refresh', [ AuthController::class, 'refresh']);
});
