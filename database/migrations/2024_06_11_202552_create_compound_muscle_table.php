<?php

use App\Models\Muscle;
use App\Models\Compound;
use App\Models\CompoundMuscle;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('compound_muscles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('compound_id');
            $table->unsignedBigInteger('muscle_id');
            $table->timestamps();

            $table->foreign('compound_id')->references('id')->on('compounds')->onDelete('cascade');
            $table->foreign('muscle_id')->references('id')->on('muscles')->onDelete('cascade');
        });

        $this->seedCompoundMuscleAssociations();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compound_muscles');
    }

    private function seedCompoundMuscleAssociations()
    {
        $compounds = Compound::all();

        foreach ($compounds as $compound) {
            $muscles = [];

            // Associate muscles with compounds based on compound name
            switch ($compound->name) {
                case 'Levantamento Terra (Deadlift)':
                    $muscles = ['Isquiotibiais', 'Glúteos', 'Eretores espinhais', 'Trapézios', 'Abdominais', 'Antebraços'];
                    break;
                case 'Supino Reto (Bench Press)':
                    $muscles = ['Peitoral maior', 'Tríceps', 'Deltoides (anterior, posterior)'];
                    break;
                case 'Agachamento Livre (Back Squat)':
                    $muscles = ['Quadríceps', 'Isquiotibiais', 'Glúteos', 'Eretores espinhais'];
                    break;
                case 'Desenvolvimento com Barra (Overhead Press)':
                    $muscles = ['Deltoides (anterior, posterior)', 'Peitoral maior', 'Tríceps', 'Abdominais'];
                    break;
                default:
                    break;
            }

            // Get muscle IDs and associate them with the compound
            foreach ($muscles as $muscleName) {
                $muscle = Muscle::where('name', $muscleName)->first();
                if ($muscle) {
                    CompoundMuscle::create([
                        'compound_id' => $compound->id,
                        'muscle_id' => $muscle->id,
                    ]);
                }
            }
        }
    }
};
