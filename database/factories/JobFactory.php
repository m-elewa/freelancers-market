<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Job;
use App\User;
use Faker\Generator as Faker;

$factory->define(Job::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'title' => $faker->realText($faker->numberBetween(50,70)),
        'description' => $faker->realText($faker->numberBetween(300,600)),
        'created_at' => $faker->dateTimeThisMonth(),
    ];
});