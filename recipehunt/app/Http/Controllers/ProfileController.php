<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Comment;
use App\Recipe;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->favfood = $request->food;
        $user->location = $request->location;
        $user->save();

        return redirect('/profile');
    }
}
