<?php

namespace App\Http\Controllers;

use App\Like;
use App\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function likeTweet(Request $request){
        $validatedData = $request->validate([
            'tweet_id' => 'required',
            'user_id' => 'required'
        ]);
        $tweet = Tweet::find($request['tweet_id']);
//        return response($tweet->likedBy, 200);
        $like = Like::where([
            'tweet_id' => $request['tweet_id']
            ,'user_id' => $request['user_id']])->first();
        if($like){
            $like->delete();
            return response('Unliked', 200);
        }
        else{
        $like = Like::firstOrCreate([
            'tweet_id' => $request['tweet_id']
            ,'user_id' => $request['user_id']]);
        return response('Liked', 200);
        }
    }

}
