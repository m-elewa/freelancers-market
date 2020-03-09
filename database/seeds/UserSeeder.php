<?php

use App\Bid;
use App\Job;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $isRandum = config('app.seed_randum_amount');
        // create 30 users and 8 jobs for each one
        factory(User::class, $isRandum ? $faker->numberBetween(25, 40) : 30)->create()->each(function ($user) use ($isRandum, $faker) {
            $user->jobs()->createMany(factory(Job::class, $isRandum ? $faker->numberBetween(7, 12) : 8)->make(['user_id' => null])->toArray());
        });

        // create the default user
        $user = factory(User::class)->create([
            'first_name' => 'Mahmoud',
            'last_name' => 'Elewa',
            'email' => 'admin@fuc.com',
            'upwork_profile_link' => '~012cdf4275117c54ca',
            'role_id' => Role::ADMIN_ROLE,
        ]);

        // create 20 bid for the default user
        Job::inRandomOrder()->take($isRandum ? $faker->numberBetween(0, 25) : 20)->get()->each(function ($job) use ($user) {
            $user->bids()->create(factory(Bid::class)->make(['user_id' => null, 'job_id' => $job->id])->toArray());
        });

        // create 30 jobs for the default user
        $user->jobs()->createMany(factory(Job::class, $isRandum ? $faker->numberBetween(28, 35) : 30)->make(['user_id' => null])->toArray());

        // create 12 bids for each job
        Job::all()->each(function ($job) use ($user, $isRandum, $faker) {
            User::where('id', '<>', $user->id)->inRandomOrder()->take($isRandum ? $faker->numberBetween(0, 15) : 12)->get()->each(function ($user) use ($job) {
                $user->bids()->create(factory(Bid::class)->make(['user_id' => null, 'job_id' => $job->id])->toArray());
            });
        });
    }
}
