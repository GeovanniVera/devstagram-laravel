<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

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

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|min:3|max:100',
            'description' => 'required|min:3|max:255',
            'image' => 'required'
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
        Gate::allows('delete', $post);
        $post->delete();
        $imagePath = public_path('uploads/'.$post->image); 
        if(File::exists($imagePath)){
            unlink($imagePath);
        }
        return redirect()->route('posts.index', Auth::user()->username);
    }
}

