<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WorkoutLevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('workout_levels')->insert([
            ['workout_id' => 1, 'level_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['workout_id' => 1, 'level_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['workout_id' => 2, 'level_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['workout_id' => 3, 'level_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['workout_id' => 4, 'level_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['workout_id' => 5, 'level_id' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
