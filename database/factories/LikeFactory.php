<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Like::class, function (Faker $faker) {
    return [
        'user_id' => \App\User::all()->random()->id,
        'tweet_id' =>\App\Tweet::all()->random()->id,
    ];
});
