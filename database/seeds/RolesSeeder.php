<?php

use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
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
                'title' => $role['name'],
                'name' => $role['name']
            ]);
        }
    }

    private function roles(): array
    {
        return [
            [
                'name' => 'client',
                'title' => 'Client'
            ],
        ];
    }
}
