<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            WorkoutSeeder::class,
            GoalsSeeder::class,
            LevelsSeeder::class,
            WorkoutGoalsSeeder::class,
            WorkoutLevelsSeeder::class,
            WeekSeeder::class,
            DaySeeder::class,
            DayExerciseSeeder::class,
        ]);
    }
}
