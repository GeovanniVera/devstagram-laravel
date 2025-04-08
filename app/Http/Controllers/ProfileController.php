<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;



class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function store(Request $request)
    {
        $request->request->add([
            'username' => Str::slug($request->username)
        ]);

        $request->validate([
            'username' => [
                'required',
                'unique:users,username,' . Auth::user()->id,
                'min:3',
                'max:20',
                'not_in:twitter,facebook,instagram,editar,editar-perfil',
            ],
        ]);

        if ($request->image) {
            //validamos la imagen 
            $manager = new ImageManager(new Driver());
            $image = $request->file('image');
            $imageName = Str::uuid() . "." . $image->extension();
            $imageServer = $manager->read($image);
            $imageServer->scale(1000, 1000);
            $imageServer->save(public_path('profile') . '/' . $imageName);

            //eliminamos la imagen anterior 
            if(Auth::user()->image) {
                $imagePath = public_path('profile') . '/' . Auth::user()->image;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        } 

        //Guardamos los datos en la base de datos

        $user = User::find(Auth::user()->id);
        $user->username = $request->username;
        $user->image = $imageName ?? $user->image ?? 'usuario.svg';
        $user->save();

        //Redireccionamos al usuario a su perfil
        return redirect()->route('posts.index', $user->username)
            ->with('success', 'Se ha actualizado tu perfil correctamente');
    }
}
