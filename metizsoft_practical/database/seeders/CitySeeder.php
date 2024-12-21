<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;
use Carbon\Carbon;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        City::insert([
            ['name' => 'Ahmedabad', 'state_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Rajkot', 'state_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Mumbai', 'state_id' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Pune', 'state_id' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'New Delhi', 'state_id' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Los Angeles', 'state_id' => 4, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'San Francisco', 'state_id' => 4, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Houston', 'state_id' => 5, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Austin', 'state_id' => 5, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
