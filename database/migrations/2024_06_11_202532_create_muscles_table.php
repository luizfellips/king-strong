<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('muscles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $muscles = [
            "Quadríceps",
            "Isquiotibiais",
            "Glúteos",
            "Eretores espinhais",
            "Trapézios",
            "Deltoides (anterior, posterior)",
            "Peitoral maior",
            "Tríceps",
            "Serrátil anterior",
            "Abdominais",
            "Adutores",
            "Antebraços",
        ];

        foreach ($muscles as $muscle) {
            DB::table('muscles')->insert([
                'name' => $muscle
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('muscles');
    }
};
