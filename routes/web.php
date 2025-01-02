<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('auth')->group(function () {
    Route::get('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'register']);
});
