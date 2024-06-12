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
        Schema::create('compounds', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('short_description');
            $table->string('image_path');
            $table->timestamps();
        });

        DB::table('compounds')->insert([
            'name' => 'Levantamento Terra (Deadlift)',
            'description' => 'O levantamento terra é um exercício composto que envolve
                        levantar uma barra carregada do chão até a posição de pé, enquanto mantém a coluna vertebral em
                        uma posição neutra.',
            'short_description' => 'O levantamento terra recruta diversos agrupamentos musculares da todo o corpo, tanto de forma
                            ativa quanto de forma isométrica.',
            'image_path' => 'img/lifts/deadlift.png',
        ]);

        DB::table('compounds')->insert([
            'name' => 'Supino Reto (Bench Press)',
            'description' => 'O supino com barra é um exercício que envolve deitar em um banco horizontal
            e empurrar uma barra para cima a partir do peito até que os braços estejam estendidos.',
            'short_description' => 'É um exercício composto indispensável para o desenvolvimento dos músculos do peito, ombros e tríceps.',
            'image_path' => 'img/lifts/bench.png',
        ]);

        DB::table('compounds')->insert([
            'name' => 'Agachamento Livre (Back Squat)',
            'description' => 'O agachamento livre é um exercício que envolve abaixar o corpo
            enquanto segura uma barra apoiada nos ombros e, em seguida, retornar à posição inicial.',
            'short_description' => 'É um exercício indispensável para os grupos musculares inferiores e músculos estabilizadores',
            'image_path' => 'img/lifts/squat.png',

        ]);

        DB::table('compounds')->insert([
            'name' => 'Desenvolvimento com Barra (Overhead Press)',
            'description' => ' A overhead press é um exercício que envolve levantar uma barra do nível dos ombros
            até uma posição totalmente estendida acima da cabeça, mantendo o tronco ereto',
            'short_description' => 'É um excelente exercício para desenvolver força nos ombros, bem como estabilidade no core e em outros exercícios.',
            'image_path' => 'img/lifts/overhead.png',

        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compounds');
    }
};
