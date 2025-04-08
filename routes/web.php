<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FollowerController;
use App\Models\Follower;

/**
 * Rutas Sin proteccion
 */


Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
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
    
    //Rutas para el perfil
    Route::get('/update-profile',[ ProfileController::class,'index'])->name('profile.index');
    Route::post('/update-profile',[ ProfileController::class,'store'])->name('profile.store');

     //Seguidores
     Route::post('/{user:username}/follow',[FollowerController::class,'store'])->name('follower.follow');
     Route::delete('/{user:username}/unfollow',[FollowerController::class,'destroy'])->name('follower.unfollow'); 

    //Posts
    Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');
    Route::get('/post/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::post('/post/{post}/likes',[LikeController::class,'store'])->name('posts.likes.store');
    Route::delete('/post/{post}/likes',[LikeController::class,'destroy'])->name('posts.likes.destroy');
    //Comentarios
    Route::post('/posts/{post}', [CommentController::class, 'store'])->name('comments.store');
    //Procesamiento de imagenes 
    Route::post('/imagenes',[ImagenController::class,'store'])->name('images.store');
    
   
    //Logout
    Route::post('/logout', [LogoutController::class, 'store'])->name('logout');
    
});