<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WorkoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('workouts')->insert([
            [
                'name' => 'Beginner Strength',
                'description' => 'This 4-Day Upper Lower Program is designed by Alberto Nuñez, who is the head bodybuilding coach at 3D Muscle Journey. Alberto is an accomplished lifelong natural bodybuilder, having most recently won Mr. Universe at the 2022 WNBF.

                    Alberto Nuñez designed this program to target your upper and lower body muscles twice a week. Additionally, there are 4 program variations for you to choose from, with each focused more on a specific muscle group while still targeting the entire body.

                    Program Variations

                    Arms dominant (biceps, triceps, shoulders)

                    Torso dominant (chest, back, lats)

                    Quad dominant (quadriceps, thigh)

                    Glute-ham dominant (butt, hamstrings)

                    Read the full guide below for an overview of the program and progression guidance.',
                'length_in_weeks' => 8,
                'workouts_per_week' => 3,
                'minutes_per_workout' => 45,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Advanced Strength',
                'description' => 'An advanced strength training program for experienced lifters',
                'length_in_weeks' => 12,
                'workouts_per_week' => 4,
                'minutes_per_workout' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cardio Blast',
                'description' => 'A high-intensity cardio program',
                'length_in_weeks' => 6,
                'workouts_per_week' => 5,
                'minutes_per_workout' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Yoga for Flexibility',
                'description' => 'A yoga program to improve flexibility and reduce stress',
                'length_in_weeks' => 10,
                'workouts_per_week' => 2,
                'minutes_per_workout' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Full Body Workout',
                'description' => 'A comprehensive workout program targeting all muscle groups',
                'length_in_weeks' => 8,
                'workouts_per_week' => 3,
                'minutes_per_workout' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
