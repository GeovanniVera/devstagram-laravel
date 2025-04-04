<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class ImagenController extends Controller
{
    public function store(Request $request)
    {
        $manager = new ImageManager(new Driver());
        $imagen = $request->file('file'); 
        $nombreImagen = Str::uuid() . "." . $imagen->extension();
        $imagenServidor = $manager->read($imagen);
        $imagenServidor->scale(1000, 1000);
        $imagenServidor->save(public_path('uploads') . '/' . $nombreImagen);
        return response()->json(['imagen' => $nombreImagen]);
    }
}
