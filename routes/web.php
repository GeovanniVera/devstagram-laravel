<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
//Rutas de login
Route::get('/', [LoginController::class, 'index']);
Route::get('/auth', [LoginController::class, 'auth']);
//Rutas de register
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'register']);
