<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index(User $user){

        $posts = Post::where('user_id', $user->id)->paginate(4);
        return view('dashboard',[
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|max:2048'
        ]);


        $request->user()->posts()->create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('posts.index', Auth::user()->username);
    }
    
    public function show(User $user,Post $post){
        $comments = Comment::where('post_id', $post)->get();
        return view('posts.show',[
            'post' => $post,
            'comments' => $comments,
        ]);
    }

    public function destroy(Post $post){
        $post->delete();
        return redirect()->route('posts.index', Auth::user()->username);
    }
}

