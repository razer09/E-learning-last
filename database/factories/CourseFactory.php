<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
     $users = App\User::pluck('id')->toArray();
    return [
        'title'         => $faker->name,
        'user_id'       => $faker->randomElement($users),
        'excerpt'       => $faker->text,
        'description'   => $faker->text,
        'thubnail'      => $faker->url,
        'old_price'     => $faker->randomDigit,
        'price'         => $faker->randomDigit
    ];
});
