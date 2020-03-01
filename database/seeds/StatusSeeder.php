<?php

use App\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->statuses() as $status) {
            Status::create([
                'key' => $status['name'],
                'name' => $status['name']
            ]);
        }
    }

    private function statuses(): array
    {
        return [
            [
                'key' => 'active',
                'name' => 'Active'
            ],
            [
                'key' => 'archived',
                'name' => 'Archived'
            ],
            [
                'key' => 'blocked',
                'name' => 'blocked'
            ],
        ];
    }
}
