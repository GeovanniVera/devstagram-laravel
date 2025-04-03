<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

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

}

