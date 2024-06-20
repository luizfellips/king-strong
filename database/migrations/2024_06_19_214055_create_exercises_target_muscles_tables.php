<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $this->seedExercises();

        Schema::create('target_muscles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $this->seedTargetMuscles();

        Schema::create('exercise_target_muscles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exercise_id');
            $table->unsignedBigInteger('target_muscle_id');
            $table->timestamps();

            $table->foreign('exercise_id')->references('id')->on('exercises')->onDelete('cascade');
            $table->foreign('target_muscle_id')->references('id')->on('target_muscles')->onDelete('cascade');
        });

        $this->seedExerciseTargetMuscles();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercise_target_muscles');
        Schema::dropIfExists('target_muscles');
        Schema::dropIfExists('exercises');
    }

    private function seedExercises()
    {
        $exercises = [
            'Levantamento Terra',
            'Stiff',
            'Supino Reto Barra',
            'Supino Inclinado Máquina',
            'Desenvolvimento Máquina',
            'Puxada Alta',
            'Agachamento Livre',
            'Leg Hack',
            'Remada Curvada',
            'Agachamento Búlgaro',
            'Cadeira Flexora',
            'Elevação Pélvica'
        ];

        $exerciseData = array_map(function($exercise) {
            return ['name' => $exercise];
        }, $exercises);

        DB::table('exercises')->insert($exerciseData);
    }

    private function seedTargetMuscles()
    {
        $targetMuscles = [
            'Quadríceps',
            'Costas',
            'Peitoral',
            'Ombros',
            'Cadeia Posterior',
            'Trapézios',
            'Tríceps',
            'Bíceps',
            'Glúteos'
        ];

        $targetMusclesData = array_map(function($targetMuscle) {
            return ['name' => $targetMuscle];
        }, $targetMuscles);

        DB::table('target_muscles')->insert($targetMusclesData);
    }

    private function seedExerciseTargetMuscles()
    {
        // Define as relações entre exercícios e músculos
        $exerciseTargetMuscles = [
            'Levantamento Terra' => ['Cadeia Posterior', 'Costas', 'Trapézios', 'Glúteos'],
            'Stiff' => ['Cadeia Posterior', 'Trapézios'],
            'Supino Reto Barra' => ['Peitoral', 'Tríceps', 'Ombros'],
            'Supino Inclinado Máquina' => ['Peitoral', 'Tríceps', 'Ombros'],
            'Desenvolvimento Máquina' => ['Ombros', 'Tríceps'],
            'Puxada Alta' => ['Costas', 'Bíceps'],
            'Agachamento Livre' => ['Glúteos', 'Quadríceps', 'Cadeia Posterior'],
            'Leg Hack' => ['Quadríceps', 'Glúteos'],
            'Remada Curvada' => ['Costas', 'Bíceps'],
            'Agachamento Búlgaro' => ['Quadríceps', 'Glúteos'],
            'Cadeira Flexora' => ['Cadeia Posterior'],
            'Elevação Pélvica' => ['Cadeia Posterior', 'Glúteos'],
        ];

        $exerciseIds = DB::table('exercises')->pluck('id', 'name')->toArray();
        $targetMuscleIds = DB::table('target_muscles')->pluck('id', 'name')->toArray();

        $exerciseTargetMuscleData = [];

        foreach ($exerciseTargetMuscles as $exercise => $targetMuscles) {
            // get current looped exercise Id
            $exerciseId = $exerciseIds[$exercise];

            foreach ($targetMuscles as $muscleName) {
                // get current looped targeted muscle id
                $muscleId = $targetMuscleIds[$muscleName];

                // populate table with necessary ids
                $exerciseTargetMuscleData[] = [
                    'exercise_id' => $exerciseId,
                    'target_muscle_id' => $muscleId
                ];
            }
        }

        DB::table('exercise_target_muscles')->insert($exerciseTargetMuscleData);
    }
};
