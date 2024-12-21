<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Noneworkingday;
use Carbon\Carbon;

class NoneworkingdaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $months = ['2024-12', '2025-01', '2025-02', '2025-03'];
        $holidays = ['2024-12-25', '2025-01-01', '2025-01-26', '2025-03-08'];

        $now = Carbon::now();

        foreach ($months as $month) {
            $daysInMonth = Carbon::parse($month . '-01')->daysInMonth;

            for ($day = 1; $day <= $daysInMonth; $day++) {
                $date = Carbon::parse("$month-$day");
                $dayOfWeek = $date->dayOfWeek;

                if ($dayOfWeek === Carbon::SATURDAY || $dayOfWeek === Carbon::SUNDAY) {
                    Noneworkingday::create([
                        'date' => $date->format('Y-m-d'),
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }
        }

        foreach ($holidays as $holiday) {
            Noneworkingday::create([
                'date' => $holiday,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
