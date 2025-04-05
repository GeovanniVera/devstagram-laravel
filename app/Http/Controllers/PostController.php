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
        $posts = Post::where('user_id', $user->id)->paginate(4);
        return view('dashboard',[
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    public function create(){
        return View('posts.create');
    }

    public function store(Request $request){

        
        $request->validate([
            'title' => 'required|min:3|max:100',
            'description' => 'required|max:1000',
            'image' => 'required'
        ]);

        $request->user()->posts()->create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
        ]);

        return redirect()->route('posts.index', Auth::user()->username)->with('success', 'Post creado correctamente');
    }

    public function show(User $user,Post $post){
        return view('posts.show',[
            'post' => $post,
        ]);
    }

}

