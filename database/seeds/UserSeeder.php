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
        // create 30 users and 5 jobs for each one
        factory(User::class, 30)->create()->each(function ($user) {
            $user->jobs()->createMany(factory(Job::class, 8)->make()->toArray());
        });

        // create the default user
        $user = factory(User::class)->create([
            'email' => 'admin@fuc.com',
            'role_id' => Role::ADMIN_ROLE,
        ]);

        // create 20 bid for the default user
        $jobs = Job::inRandomOrder()->take(20)->get();
        foreach ($jobs as $job) {
            factory(Bid::class)->create(['user_id' => $user->id, 'job_id' => $job->id]);
        }

        // create 30 jobs for the default user
        $user->jobs()->createMany(factory(Job::class, 30)->make()->toArray());

        // create 5 bids for each job
        Job::all()->each(function ($job) use ($user) {
            $users = User::where('id', '<>', $user->id)->inRandomOrder()->take(8)->get();
            foreach ($users as $user) {
                factory(Bid::class)->create(['user_id' => $user->id, 'job_id' => $job->id]);
            }
        });
    }
}
