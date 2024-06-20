<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WorkoutGoalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('workout_goals')->insert([
            ['workout_id' => 1, 'goal_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['workout_id' => 1, 'goal_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['workout_id' => 2, 'goal_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['workout_id' => 3, 'goal_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['workout_id' => 4, 'goal_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['workout_id' => 5, 'goal_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['workout_id' => 5, 'goal_id' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
