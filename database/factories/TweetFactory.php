<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Tweet::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraph(1),
        'user_id' => \App\User::all()->random()->id
    ];
});
