<?php

use App\Bid;
use App\Job;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'email' => 'admin@fuc.com',
            'role_id' => Role::ADMIN_ROLE,
        ])->each(function ($user) {
            $user->jobs()->createMany(factory(Job::class, 30)->make()->toArray())->each(function ($job) {
                $job->bids()->createMany(factory(Bid::class, 5)->make()->toArray());
            });
        });

        factory(User::class, 10)->create()->each(function ($user) {
            $user->jobs()->createMany(factory(Job::class, 5)->make()->toArray())
                ->each(function ($job) {
                $job->bids()->createMany(factory(Bid::class, 5)->make()->toArray());
            });
        });
    }
}
