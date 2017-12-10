<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SocialAccountService;
use App\Comment;
use Socialite;
use Validator;
use Auth;

class CommentController extends Controller
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
            'content' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/home')
                ->withErrors($validator)
                ->withInput();
        }

        $comment = new Comment;
        $comment->user_id = Auth::id();
        $comment->recipe_id = $request->story_id;
        $comment->comment = $request->content;
        $comment->save();

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
            'content' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/home')
                ->withErrors($validator)
                ->withInput();
        } else {
            $comment = Comment::findOrFail($id);
            $comment->comment = $request->content;
            $comment->save();
            return redirect('/home');
        }
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return redirect('/home');
    }
}
