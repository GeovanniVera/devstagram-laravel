<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagenController extends Controller
{
    public function store(Request $request){
        $image = $request->file('file');
        return response()->json(['image'=>$image->extension()]);
    }
}
