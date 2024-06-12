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
        Schema::create('strength_standards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('compound_id');
            $table->string('training_level')->nullable();
            $table->string('years_of_lifting')->nullable();
            $table->timestamps();

            $table->foreign('compound_id')->references('id')->on('compounds')->onDelete('cascade');
        });

        $this->insertDefaultRecords();
    }

    protected function insertDefaultRecords()
    {
        $strength_standards = [];

        $compound_ids = [1, 2, 3, 4];
        $training_levels = ['novice', 'beginner', 'intermediate', 'advanced', 'elite'];

        foreach ($compound_ids as $compound_id) {
            $strength_standards[] = [
                'compound_id' => $compound_id,
                'training_level' => 'novice',
                'years_of_lifting' => 'three_to_six_months'
            ];

            foreach ($training_levels as $training_level) {
                if ($training_level !== 'novice') {
                    $years_of_lifting = $this->getTimeOfTraining($training_level);
                    $strength_standards[] = [
                        'compound_id' => $compound_id,
                        'training_level' => $training_level,
                        'years_of_lifting' => $years_of_lifting
                    ];
                }
            }
        }

        foreach ($strength_standards as $standard) {
            DB::table('strength_standards')->insert($standard);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('strength_standards');
    }

    protected function getTimeOfTraining($training_level)
    {
        switch ($training_level) {
            case 'beginner':
                return 'up_to_two_years';
            case 'intermediate':
                return 'two_to_five_years';
            case 'advanced':
                return 'five_or_more_years';
            case 'elite':
                return 'ten_or_more_years';
            default:
                return '';
        }
    }
};
