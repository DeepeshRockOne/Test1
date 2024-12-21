<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;
use Carbon\Carbon;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        Country::insert([
            ['name' => 'India', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'USA', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
