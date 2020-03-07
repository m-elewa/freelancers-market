<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Bid;
use App\Job;
use App\User;
use Faker\Generator as Faker;

$factory->define(Bid::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'job_id' => function () {
            return factory(Job::class)->create()->id;
        },
        'description' => $faker->realText($faker->numberBetween(100,200)),
        'amount' => $faker->randomFloat(2, 5, 60),
        'created_at' => $faker->dateTimeThisMonth(),
    ];
});