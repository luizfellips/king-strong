<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Workouts\Program\Day;
use App\Models\Workouts\Exercises\Exercise;
use App\Models\Workouts\Program\DayExercise;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DayExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $days = Day::all();
        $exercises = Exercise::inRandomOrder()->get()->toArray();

        foreach ($days as $day) {
            shuffle($exercises);

            $randomExercises = array_slice($exercises, 0, rand(4, 5));

            foreach ($randomExercises as $exercise) {
                DayExercise::create([
                    'day_id' => $day->id,
                    'exercise_id' => $exercise['id'],
                    'sets' => rand(3, 5),
                    'reps' => rand(8, 12),
                    'rpe' => rand(1, 10),
                ]);
            }
        }
    }
}
