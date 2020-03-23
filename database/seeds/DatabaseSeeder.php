<?php

use App\Job;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    public $scoutDriver;
    public $scoutQueue;

    public function __construct()
    {
        $this->scoutDriver = config('scout.driver');
        $this->scoutQueue = config('scout.queue');

        Config::set('mail.driver', 'array');
        Config::set('queue.default', 'sync');
        Config::set('broadcasting.default', null);

        Artisan::call('scout:flush', ['model' => Job::class]);

        Config::set('scout.driver', null);
        Config::set('scout.queue', false);
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(JobSeeder::class);
        $this->call(BidSeeder::class);
        $this->call(NotificationSeeder::class);
    }

    public function __destruct()
    {
        Config::set('scout.driver', $this->scoutDriver);
        Config::set('scout.queue', $this->scoutQueue);

        Artisan::call('scout:import', ['model' => \App\Job::class]);
    }
}
