<?php

namespace App\Http\Controllers;

use App\Like;
use App\Reply;
use App\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Intervention\Image\Facades\Image as Image;

class ReplyController extends Controller
{
    public function getTweetReplies(Request $request){
        $tweet = Tweet::where('id', $request['tweet_id'])->firstOrFail();
        $replies = $tweet->replies()->with('user')->orderBy('created_at', 'desc')->paginate(10);
//        foreach ($replies as $reply){
//            if(!$request['user_id'])
//                $isLiked = false;
//            else
//                $isLiked = Like::userLikesTweet($request['user_id'], $tweet->id);
//            $tweet->isLiked = $isLiked;
//        }
        return response()->json($replies);
    }
    public function create(Request $request){
        $validatedData = $request->validate([
            'body' => 'required|max:250',
            'tweet_id' => 'required',

        ]);
        $reply = Reply::create(
            [
                'user_id' => Auth::user()->id,
                'tweet_id' =>$request['tweet_id'],
                'body' => $request['body'],
            ]
        );
        return response('success', 200);

    }
}
