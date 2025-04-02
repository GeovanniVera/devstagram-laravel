<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index() {
        return view('auth.login');
    }

    public function store(Request $request) {
        //Validamos datos
        $rules = [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
        $request->validate($rules);

        if(auth->attemp($request->only('email','password')));
    }
}
