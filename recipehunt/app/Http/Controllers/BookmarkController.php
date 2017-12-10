<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bookmark;
use App\Recipe;
use App\User;
use Auth;

class BookmarkController extends Controller
{
    public function bookmark($id) {

        $exists = Bookmark::where([
            ['recipe_id', $id],
            ['user_id', Auth::id()],
        ])->get();
        if($exists->isEmpty()) {
            $bookmark = new Bookmark;
            $bookmark->user_id = Auth::id();
            $bookmark->recipe_id = $id;
            $bookmark->save();
            return redirect('/home')->with('message', 'Recipe saved!');
        } else {
            return redirect('/home')->with('message', 'Bookmark already exists!');
        }

    }

    public function destroy($id) {
        $bookmark = Bookmark::findOrFail($id);
        $bookmark->delete();
    }
}
