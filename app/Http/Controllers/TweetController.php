<?php

namespace App\Http\Controllers;

use App\Like;
use App\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Intervention\Image\Facades\Image as Image;

class TweetController extends Controller
{
    public function create(Request $request){
        $validatedData = $request->validate([
            'body' => 'required|max:250'
        ]);
        $tweet = Tweet::create(
            [
                'user_id' => Auth::user()->id,
                'body' => $request['body'],
            ]
        );
        if($request['attachment'])
        {
            $image = $request['attachment'];
            $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            $attachment = Image::make($request['attachment'])->save(public_path('attachments/').$name);
            $attachment->resize(500,500);
            $tweet->attachment = URL::to('/') . '/attachments/' . $name;
            $tweet->save();
        }
        //Oh god
        $tweet = Tweet::with(['user', 'likedBy'])->where('id', $tweet->id)->first();
        return response(['tweet'=>$tweet], 200);

    }

    public function getAll(Request $request){
        $tweets = Tweet::with(['user', 'likedBy'])->orderBy('created_at', 'desc')->paginate(10);
        foreach ($tweets as $tweet){
            if(!$request['user_id'])
                $isLiked = false;
            else
                $isLiked = Like::userLikesTweet($request['user_id'], $tweet->id);
            $tweet->isLiked = $isLiked;
        }
        return response()->json($tweets);
    }

    public function getUserTweets(Request $request){
        $tweets = Tweet::where('user_id', $request['tweeter_id'])->with(['user', 'likedBy'])->orderBy('created_at', 'desc')->paginate(10);
        foreach ($tweets as $tweet){
            if(!$request['user_id'])
                $isLiked = false;
            else
                $isLiked = Like::userLikesTweet($request['user_id'], $tweet->id);
            $tweet->isLiked = $isLiked;
        }
        return response()->json($tweets);
    }
}
