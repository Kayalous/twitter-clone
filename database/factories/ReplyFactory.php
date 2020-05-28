<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Reply::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraph(1),
        'user_id' => \App\User::all()->random()->id,
        'tweet_id' =>\App\Tweet::all()->random()->id,
    ];
});
