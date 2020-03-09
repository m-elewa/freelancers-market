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
        // create 30 users and 8 jobs for each one
        factory(User::class, 30)->create()->each(function ($user) {
            $user->jobs()->createMany(factory(Job::class, 8)->make(['user_id' => null])->toArray());
        });

        // create the default user
        $user = factory(User::class)->create([
            'email' => 'admin@fuc.com',
            'role_id' => Role::ADMIN_ROLE,
        ]);

        // create 20 bid for the default user
        Job::inRandomOrder()->take(20)->get()->each(function ($job) use ($user) {
            $user->bids()->create(factory(Bid::class)->make(['user_id' => null, 'job_id' => $job->id])->toArray());
        });

        // create 30 jobs for the default user
        $user->jobs()->createMany(factory(Job::class, 30)->make(['user_id' => null])->toArray());

        // create 12 bids for each job
        Job::all()->each(function ($job) use ($user) {
            User::where('id', '<>', $user->id)->inRandomOrder()->take(12)->get()->each(function ($user) use ($job) {
                $user->bids()->create(factory(Bid::class)->make(['user_id' => null, 'job_id' => $job->id])->toArray());
            });
        });
    }
}
