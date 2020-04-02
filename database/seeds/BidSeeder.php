<?php

use App\Bid;
use App\Job;
use App\User;
use Illuminate\Database\Seeder;

class BidSeeder extends Seeder
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
        
        // create 12 bids for each job
        Job::all()->each(function ($job) use ($defaultUser, $isRandum) {
            User::whereNotIn('id', [$defaultUser->id, $job->user_id])->inRandomOrder()->take($isRandum ? rand(0, 15) : 12)->get()->each(function ($user) use ($job) {
                $user->bids()->create(factory(Bid::class)->make(['user_id' => null, 'job_id' => $job->id])->toArray());
            });
        });

        // create 20 bid for the default user
        Job::inRandomOrder()->take($isRandum ? rand(18, 25) : 20)->get()->each(function ($job) use ($defaultUser) {
            $defaultUser->bids()->create(factory(Bid::class)->make(['user_id' => null, 'job_id' => $job->id])->toArray());
        });
    }
}
