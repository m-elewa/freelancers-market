<?php

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
        $isRandum = config('setting.seed_randum_amount');

        // create 30 users
        factory(User::class, $isRandum ? rand(24, 40) : 30)->create();

        // create the default user
        $user = factory(User::class)->create([
            'first_name' => 'Mahmoud',
            'last_name' => 'Elewa',
            'email' => 'admin@example.com',
            'role_id' => Role::ADMIN_ROLE,
        ]);
    }
}
