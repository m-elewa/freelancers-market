<?php

use App\Job;
use App\User;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $isRandum = config('setting.seed_randum_amount');

        $defaultUser = User::admin()->first();

        // create 8 jobs for each one
        User::where('id', '<>', $defaultUser->id)->get()->each(function ($user) use ($isRandum) {
            $user->jobs()->createMany(factory(Job::class, $isRandum ? rand(7, 12) : 8)->make(['user_id' => null])->toArray());
        });

        // create 30 jobs for the default user
        $defaultUser->jobs()->createMany(factory(Job::class, $isRandum ? rand(28, 35) : 30)->make(['user_id' => null])->toArray());

         
    }
}
