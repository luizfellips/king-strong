<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('levels')->insert([
            ['name' => 'Beginner', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Advanced', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Intermediate', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Elite', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
