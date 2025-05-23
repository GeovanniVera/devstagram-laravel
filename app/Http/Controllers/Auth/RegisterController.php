<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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

        //reglas de validacion
        $rules = [
            'name' => [
                'required',
                'min:5',
                'max:100',
            ],
            'username' => ['required', 'min:5', 'max:30', 'unique:users'],
            'email' => ['required', 'min:5', 'max:80', 'unique:users', 'email'],
            'password' => [
                'required',
                'confirmed',
                'min:8',
            ],
        ];

        //validamos los datos usando las reglas de validacion
        $request->validate($rules);

        //uso de eloquent ORM 
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        //autenticar un usuario guardamos al usuario en la sesion
        Auth::attempt($request->only('email','password','username'));
        //redireccionar al usuario
        return redirect()->route('posts.index',['user' => Auth::user()->username]);
    }
}
