<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Job;
use App\Status;
use App\User;
use Faker\Generator as Faker;

$factory->define(Job::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->paragraphs(3, true),
        'status_id' => Status::ACTIVE_STATUS,
    ];
});