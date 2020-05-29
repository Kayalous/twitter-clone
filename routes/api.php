<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/get/tweets/all', 'TweetController@getAll');
Route::get('/get/tweets/user', 'TweetController@getUserTweets');


Route::get('/get/tweet/replies', 'ReplyController@getTweetReplies');
