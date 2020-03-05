<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Job;
use Faker\Generator as Faker;

$factory->define(Job::class, function (Faker $faker) {
    return [
        'title' => $faker->realText($faker->numberBetween(50,70)),
        'description' => $faker->realText($faker->numberBetween(300,600)),
        'created_at' => $faker->dateTimeThisMonth(),
    ];
});