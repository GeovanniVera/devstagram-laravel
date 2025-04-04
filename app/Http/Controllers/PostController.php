<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{

    
    public function index(User $user){
        return view('dashboard',[
            'user' => $user
        ]);
    }

    public function create(){
        return View('posts.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|min:3|max:100',
            'description' => 'required|max:1000',
            'image' => 'required|image|max:2048'
        ]);

        //Almacenar el post en la bd
        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->file('image')->store('posts', 'public'),
            'user_id' => Auth::user()->id
        ]);
        //Redireccionar al usuario
        return redirect()->route('posts.index', Auth::user()->username)->with('success', 'Post creado correctamente');
    }


}

