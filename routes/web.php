<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
//Rutas de login
Route::get('/', [LoginController::class, 'index']);
Route::post('/auth', [LoginController::class, 'auth']);
//Rutas de register
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

