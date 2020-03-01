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
        factory(Job::class, 50)->create([
            'user_id' => factory(User::class)
        ]);
    }
}
