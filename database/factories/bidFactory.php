<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Bid;
use App\Job;
use App\User;
use App\Status;
use Faker\Generator as Faker;

$factory->define(Bid::class, function (Faker $faker) {
    return [
        'description' => $faker->realText($faker->numberBetween(100,200)),
        'amount' => $faker->randomFloat(2, 5, 60),
        'status_id' => Status::ACTIVE_STATUS,
        'created_at' => $faker->dateTimeThisMonth(),
    ];
});