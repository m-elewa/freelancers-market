<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Role;
use App\Status;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'slug' => function (array $user) {
            return Str::slug($user['first_name'] . ' ' . $user['last_name']);  // TODO: make it unique
        },
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'role_id' => Role::USER_ROLE,
        'status_id' => Status::ACTIVE_STATUS,
        'password' => bcrypt('password'),
        'remember_token' => Str::random(10),
    ];
});
