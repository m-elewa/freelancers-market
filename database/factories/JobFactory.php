<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Job;
use App\Status;
use App\User;
use Faker\Generator as Faker;

$factory->define(Job::class, function (Faker $faker) {
    return [
        'title' => $faker->realText($faker->numberBetween(50,70)),
        'description' => $faker->realText($faker->numberBetween(300,600)),
        'status_id' => Status::ACTIVE_STATUS,
        'created_at' => $faker->dateTimeThisMonth(),
    ];
});