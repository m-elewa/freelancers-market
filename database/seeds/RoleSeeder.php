<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->roles() as $role) {
            Role::create([
                'key' => $role['name'],
                'name' => $role['name']
            ]);
        }
    }

    private function roles(): array
    {
        return [
            [
                'name' => 'User',
                'key' => 'user'
            ],
            [
                'name' => 'Admin',
                'key' => 'admin'
            ],
        ];
    }
}
