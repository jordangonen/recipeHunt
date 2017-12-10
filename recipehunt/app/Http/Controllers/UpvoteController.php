<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Upvote;
use App\Recipe;
use App\User;
use Auth;

class UpvoteController extends Controller
{
    public function check($id) {
        $exists = Upvote::where([
            ['recipe_id', $id],
            ['user_id', Auth::id()],
        ])->get();
        if($exists->isEmpty()) {

            $recipe = Recipe::findOrFail($id);
            $recipe->upvotes = $recipe->upvotes+1;
            $recipe->save();

            $upvote = new Upvote;
            $upvote->user_id = Auth::id();
            $upvote->recipe_id = $id;
            $upvote->save();

        } else {

        }
        return redirect('/home');
    }

    public function destroy($id) {
        $upvote = Upvote::findOrFail($id);
        $upvote->delete();
    }
}
