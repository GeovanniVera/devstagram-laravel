<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

//Pagina Principal
Route::get('/', function() {
    return view('principal');
});
//Rutas de login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
//Rutas de register
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
//post Route Model Binding
Route::get('/{user:username}',[PostController::class,'index'])->name('posts.index');
//Logout
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');