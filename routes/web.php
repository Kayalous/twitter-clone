<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('/u/{handle}', function ($handle) {
    $user = \App\User::where('handle', $handle)->first();
    return view('profile', ['user' => $user]);
});
Route::get('/thread/{tweet_id}', function ($tweet_id) {
    $tweet = \App\Tweet::with(['user', 'likedBy', 'replies'])->where('id', $tweet_id)->firstOrFail();
    return view('thread', ['tweet' => $tweet]);
});

Route::get('/manage/profile', function () {
    return view('manage-profile');
});


Route::get('/logout', 'Auth\LoginController@logout');



Route::post('/new/tweet', 'TweetController@create');
Route::post('/new/reply', 'ReplyController@create');
Route::post('/like/tweet', 'LikeController@likeTweet');
Route::post('/manage/profile', 'UserController@update');
Auth::routes();


