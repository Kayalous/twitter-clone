<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['tweet_id', 'user_id'];

    public static function userLikesTweet($user_id, $tweet_id){
        $like = Like::where([
            'tweet_id' => $tweet_id
            ,'user_id' => $user_id])->first();
        if($like) return true;
        return false;
    }
}
