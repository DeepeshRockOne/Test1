<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\State;
use Carbon\Carbon;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        State::insert([
            ['name' => 'Gujarat', 'country_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Maharashtra', 'country_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Delhi', 'country_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'California', 'country_id' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Texas', 'country_id' => 2, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
