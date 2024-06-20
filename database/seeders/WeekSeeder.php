<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Workouts\Workout;
use App\Models\Workouts\Program\Week;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WeekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workouts = Workout::all();

        foreach ($workouts as $workout) {
            for ($i = 1; $i <= $workout->length_in_weeks; $i++) {
                Week::create([
                    'workout_id' => $workout->id,
                    'week_number' => $i
                ]);
            }
        }
    }
}
