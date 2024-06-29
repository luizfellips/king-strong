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
                'description' => 'A nice beginner program for strength gains.',
                'guide' => null,
                'img_path' => null,
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
                'guide' => null,
                'img_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cardio Blast',
                'description' => 'A high-intensity cardio program',
                'length_in_weeks' => 6,
                'workouts_per_week' => 5,
                'minutes_per_workout' => 30,
                'guide' => null,
                'img_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Yoga for Flexibility',
                'description' => 'A yoga program to improve flexibility and reduce stress',
                'length_in_weeks' => 10,
                'workouts_per_week' => 2,
                'minutes_per_workout' => 60,
                'guide' => null,
                'img_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Full Body Workout',
                'description' => 'A comprehensive workout program targeting all muscle groups',
                'length_in_weeks' => 8,
                'workouts_per_week' => 3,
                'minutes_per_workout' => 50,
                'guide' => null,
                'img_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
