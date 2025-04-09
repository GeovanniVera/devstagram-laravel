<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __invoke()
    {
        //obtener a quienes seguimos 
        $following = Auth::user()->followings->pluck('id')->toArray();
        //obtener los posts de los usuarios a quienes seguimos
        $posts = Post::whereIn('user_id', $following)
            ->latest()
            ->paginate(20);
        //pasamos los posts a la vista home
        return view('home',['posts' => $posts]);    
    }

}
