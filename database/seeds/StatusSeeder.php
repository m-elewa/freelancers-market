<?php

use App\Status;
use Illuminate\Support\Str;
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
                'key' => Str::slug($status['name']),
                'name' => $status['name']
            ]);
        }
    }

    private function statuses(): array
    {
        return [
            [
                'name' => 'Active',
                'key' => 'active'
            ],
            [
                'name' => 'Archive',
                'key' => 'archive'
            ],
            [
                'name' => 'Block',
                'key' => 'block'
            ],
        ];
    }
}
