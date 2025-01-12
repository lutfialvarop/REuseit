<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContentController;
use App\Http\Middleware\UserAccess;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(UserAccess::class)->group(function () {
    Route::prefix('dashboard/content')->group(function () {
        Route::get('/', [ContentController::class, 'index'])->name('content.index');
        Route::get('/create', [ContentController::class, 'create'])->name('content.create');
        Route::post('/store', [ContentController::class, 'store'])->name('content.store');
        Route::get('/{id}', [ContentController::class, 'detailContent'])->name('content.detail');
        Route::get('/edit/{id}', [ContentController::class, 'edit'])->name('content.edit');
        Route::put('/update/{id}', [ContentController::class, 'update'])->name('content.update');
        Route::delete('/destroy/{id}', [ContentController::class, 'destroy'])->name('content.destroy');
    });
});

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('login', [AuthController::class, 'viewLogin'])->name('auth.login.view');
    Route::post('register', [AuthController::class, 'register'])->name('auth.register');
    Route::get('register', [AuthController::class, 'viewRegister'])->name('auth.register.view');
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
});
