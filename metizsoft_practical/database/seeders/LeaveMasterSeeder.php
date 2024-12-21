<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LeaveMaster;
use Carbon\Carbon;

class LeaveMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        LeaveMaster::insert([
            ['leaveType' => 'Sick Leave', 'created_at' => $now, 'updated_at' => $now],
            ['leaveType' => 'Casual Leave', 'created_at' => $now, 'updated_at' => $now],
            ['leaveType' => 'Plan Leave', 'created_at' => $now, 'updated_at' => $now],
            ['leaveType' => 'Unpaid Leave', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
