<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Workouts\Workout;
use App\Models\Workouts\Program\Day;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workouts = Workout::with('weeks')->get();

        foreach ($workouts as $workout) {
            foreach ($workout->weeks as $week) {
                for ($i = 1; $i <= $workout->workouts_per_week; $i++) {
                    Day::create([
                        'week_id' => $week->id,
                        'day_number' => $i
                    ]);
                }
            }
        }
    }
}
