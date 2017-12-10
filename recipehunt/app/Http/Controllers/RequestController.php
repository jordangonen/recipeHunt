<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Job;
use Validator;
use Auth;

class RequestController extends Controller
{
    public function index() {
        return view('request');
    }

    public function request(Request $request) {
        $validator = Validator::make($request->all(), [
            'job' => 'required|max:120',
            'loc' => 'required|max:120',
        ]);

        if ($validator->fails()) {
            return redirect('/job')
                ->withErrors($validator)
                ->withInput();
        } else {
            $job = new Job;
            $job->user_id = Auth::id();
            $job->job = $request->job;
            $job->loc = $request->loc;
            $job->save();

            return redirect('/job');
        }
    }
}
