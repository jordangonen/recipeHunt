<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SocialAccountService;
use App\Http\Controllers\CommentController;
use App\Recipe;
use App\Comment;
use App\Upvote;
use Socialite;
use Validator;
use Auth;

class RecipeController extends Controller
{
    public function index()
    {

    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:120',
            'category' => 'required',
            'instructions' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/home')
                ->withErrors($validator)
                ->withInput();
        }

        $recipe = new Recipe;
        $recipe->user_id = Auth::id();
        $recipe->name = $request->name;
        $recipe->instructions = $request->instructions;
        $recipe->choices = $request->category;
        $recipe->upvotes = 0;
        $path = Storage::putFile('public/recipe_images', $request->file('pic'));
        $path = substr($path, 20);
        $recipe->filepath = $path;
        $recipe->save();

        return redirect('/home');
    }

    public function show()
    {
    }

    public function edit(Request $request)
    {
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:120',
            'category' => 'required',
            'instructions' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/home')
                ->withErrors($validator)
                ->withInput();
        }

        $recipe = Recipe::findOrFail($id);
        $recipe->name = $request->name;
        $recipe->instructions = $request->instructions;
        $recipe->choices = $request->category;
        $recipe->save();

        return redirect('/profile');
    }

    public function destroy($id)
    {
        $comments = Comment::where('recipe_id', $id)->get();
        foreach ($comments as $comment) {
            $comment->destroy($comment->id);
        }
        $upvotes = Upvote::where('recipe_id', $id)->get();
        // foreach($upvotes as $upvote) {
        //     $upvote->destroy($upvote->id);
        // }
        $recipe = Recipe::findOrFail($id);
        $recipe->delete();
        return redirect('/profile');
    }

    public function search(Request $request) {
        return redirect('/home')->with('search', $request->name);
    }

    public function category(Request $request) {
        return redirect('/home')->with('category', $request->category);
    }
}
