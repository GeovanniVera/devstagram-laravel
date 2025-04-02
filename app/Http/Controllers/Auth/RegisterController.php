<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {

        //Modificar el request no es mur recomendado
        $request->request->add([
            'username' => Str::slug($request->username)
        ]);

        //validaciones
        $request->validate([
            'name' => 'required|min:5|max:100',
            'username' => 'required|min:5|max:30|unique:users',
            'email' => 'required|min:5|max:80|unique:users|email',
            'password' => 'required|confirmed|min:6'
        ]);

        //uso de eloquent ORM 
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password) 
        ]);

        //redireccionar al usuario

    }
}
