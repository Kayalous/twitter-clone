<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function likeTweet(Request $request){
        $validatedData = $request->validate([
            'tweet_id' => 'required'
        ]);
        $like = Like::where([
            'tweet_id' => $request['tweet_id']
            ,'user_id' => Auth::user()->id])->first();
        if($like){
            $like->delete();
            return response('Unliked', 200);
        }
        else{
        $like = Like::firstOrCreate([
            'tweet_id' => $request['tweet_id']
            ,'user_id' => Auth::user()->id]);
        return response('Liked', 200);
        }
    }

}
