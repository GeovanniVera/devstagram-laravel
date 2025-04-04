<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ImagenController;

/**
 * Rutas Sin proteccion
 */


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/', function () {
    return view('principal');
});

/**
 * Rutas protegidas 
 * */
Route::middleware('auth')->group(function () {
    //Posts
    Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');
    Route::get('/post/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    //Procesamiento de imagenes 
    Route::post('/imagenes',[ImagenController::class,'store'])->name('images.store');

    //Logout
    Route::post('/logout', [LogoutController::class, 'store'])->name('logout');
    
});