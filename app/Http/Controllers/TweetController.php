<?php

namespace App\Http\Controllers;

use App\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    public function create(Request $request){
        $validatedData = $request->validate([
            'body' => 'required|max:250',
            'user_id' => 'required'
        ]);
        $tweet = Tweet::create(
            [
                'user_id' => $request['user_id'],
                'body'=> $request['body'],
            ]
        );
        return response('New tweet added.', 200);

    }
    public function getAll(){
        $tweets = Tweet::with('user')->orderBy('created_at', 'desc')->get();
        return json_encode($tweets);
    }
}
