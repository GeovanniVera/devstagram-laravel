<?php

namespace App\Http\Controllers;


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

    
}
