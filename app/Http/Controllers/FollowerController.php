<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    public function store(User $user ){
        $user->followers()->attach(Auth::user()->id);
        return back()->with('success', 'You are now following ' . $user->username);
    }

    public function destroy(User $user){
        $user->followers()->detach(Auth::user()->id);
        return back()->with('success', 'You arent now following ' . $user->username);
    }
}
