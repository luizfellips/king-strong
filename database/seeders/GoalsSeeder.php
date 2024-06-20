<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GoalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('goals')->insert([
            ['name' => 'Strength', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Hypertrophy', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cardio', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Flexibility', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
