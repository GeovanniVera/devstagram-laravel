<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $post)
    {

        $request->validate([
            'comment' => 'required|max:255',
        ]);

        $request->user()->comments()->create([
            'comment' => $request->comment,
            'post_id' => $post,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->back();
    }

    public function index($post)
    {
        $comments = Comment::where('post_id', $post)->get();
        return view('comments.index', [
            'comments' => $comments,
        ]);
    }
}
