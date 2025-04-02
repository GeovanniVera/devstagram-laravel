<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('auth.login');
    }

    public function store(Request $request) {
        //Definimos las reglas de validacion
        $rules = [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
        //Valida las reglas
        $request->validate($rules);

        //Verificamos que el correo exista y la contraseña sea correcta
        if(!Auth::attempt($request->only('email', 'password'),$request->remember)) {
            return back()->with('message','Credenciales Incorrectas');
        }

        //redirigimos al usuario si todo salio bien 
        return redirect()->route('posts.index',['user' => Auth::user()->username]);
    }

    
}
