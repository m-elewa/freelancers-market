<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Bid;
use App\Status;
use App\User;
use Faker\Generator as Faker;

$factory->define(Bid::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'description' => $faker->paragraphs(1, true),
        'amount' => $faker->randomFloat(2, 5, 60),
        'status_id' => Status::ACTIVE_STATUS,
    ];
});