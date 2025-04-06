<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ImagenController;

/**
 * Rutas Sin proteccion
 */


Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');;
Route::post('/login', [LoginController::class, 'store'])->middleware('guest');;

Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');;
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');;

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
    Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    //Comentarios
    Route::post('/posts/{post}', [CommentController::class, 'store'])->name('comments.store');
    //Procesamiento de imagenes 
    Route::post('/imagenes',[ImagenController::class,'store'])->name('images.store');

    //Logout
    Route::post('/logout', [LogoutController::class, 'store'])->name('logout');
    
});