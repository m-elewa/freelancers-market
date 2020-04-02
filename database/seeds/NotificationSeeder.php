<?php

use App\User;
use App\Events\BidPosted;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
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

        // create 3 notifications for 10 jobs on the notification table for the default user
        $defaultUser->jobs()->with(['bids.user', 'bids.job.user'])->take($isRandum ? rand(8, 12) : 10)->get()->each(function ($job) use ($isRandum){
            $job->bids->take($isRandum ? rand(1, 4) : 3)->each(function ($bid) {
                event(new BidPosted($bid));
            });
        });
    }
}
