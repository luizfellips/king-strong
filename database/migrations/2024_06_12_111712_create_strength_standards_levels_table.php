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
        Schema::create('strength_standards_levels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('compound_id');
            $table->string('training_level')->nullable();
            $table->string('years_of_lifting')->nullable();
            $table->float('min_ratio');
            $table->float('max_ratio');
            $table->char('gender');

            $table->foreign('compound_id')->references('id')->on('compounds')->onDelete('cascade');
        });

        $this->insertDefaultRecords();
    }

    protected function insertDefaultRecords()
    {
        $compound_ids = [1, 2, 3];

        $training_levels = ['novice', 'beginner', 'intermediate', 'advanced', 'elite'];

        $maleRatioValues = $this->getMaleRatioValues();
        $femaleRatioValues = $this->getFemaleRatioValues();

        $maleStrengthStandards = $this->generateStrengthStandards($compound_ids, $training_levels, $maleRatioValues, 'M');
        $femaleStrengthStandards = $this->generateStrengthStandards($compound_ids, $training_levels, $femaleRatioValues, 'F');

        foreach ($maleStrengthStandards as $standard) {
            DB::table('strength_standards_levels')->insert($standard);
        }

        foreach ($femaleStrengthStandards as $standard) {
            DB::table('strength_standards_levels')->insert($standard);
        }
    }

    protected function generateStrengthStandards($compound_ids, $training_levels, $ratioValues, $gender)
    {
        $strengthStandards = [];

        foreach ($compound_ids as $compound_id) {
            foreach ($training_levels as $training_level) {
                $years_of_lifting = ($training_level === 'novice') ? 'three_to_six_months' : $this->getTimeOfTraining($training_level);

                $ratioValuesForCompound = $ratioValues[$compound_id][$training_level] ?? ['min' => 1.0, 'max' => 1.0];
                $min_ratio = $ratioValuesForCompound['min'];
                $max_ratio = $ratioValuesForCompound['max'];

                $strengthStandards[] = [
                    'compound_id' => $compound_id,
                    'training_level' => $training_level,
                    'years_of_lifting' => $years_of_lifting,
                    'min_ratio' => $min_ratio,
                    'max_ratio' => $max_ratio,
                    'gender' => $gender,
                ];
            }
        }

        return $strengthStandards;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('strength_standards_levels');
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

    /**
     * // 1 -> deadlift
     * // 2 -> bench
     * // 3 -> squat
     * @return array
     */
    protected function getFemaleRatioValues()
    {
        return [
            1 => [
                'beginner' => ['min' => 0.5, 'max' => 1],
                'intermediate' => ['min' => 1.25, 'max' => 1.75],
                'advanced' => ['min' => 1.75, 'max' => 2.25],
                'elite' => ['min' => 2.25, 'max' => 3],

            ],
            2 => [
                'beginner' => ['min' => 0.5, 'max' => 0.5],
                'intermediate' => ['min' => 0.5, 'max' => 0.75],
                'advanced' => ['min' => 0.75, 'max' => 1],
                'elite' => ['min' => 1, 'max' => 1.25],
            ],
            3 => [
                'beginner' => ['min' => 0.5, 'max' => 1],
                'intermediate' => ['min' => 1, 'max' => 1.5],
                'advanced' => ['min' => 1.5, 'max' => 1.75],
                'elite' => ['min' => 1.75, 'max' => 2.25],
            ],
        ];
    }

    /**
     * // 1 -> deadlift
     * // 2 -> bench
     * // 3 -> squat
     * @return array
     */
    protected function getMaleRatioValues()
    {
        return [
            1 => [
                'beginner' => ['min' => 1.5, 'max' => 1.5],
                'intermediate' => ['min' => 1.5, 'max' => 2.25],
                'advanced' => ['min' => 2.25, 'max' => 3],
                'elite' => ['min' => 3, 'max' => 3.5],

            ],
            2 => [
                'beginner' => ['min' => 1.0, 'max' => 1.0],
                'intermediate' => ['min' => 1.0, 'max' => 1.5],
                'advanced' => ['min' => 1.5, 'max' => 1.5],
                'elite' => ['min' => 1.5, 'max' => 1.5],
            ],
            3 => [
                'beginner' => ['min' => 1.25, 'max' => 1.25],
                'intermediate' => ['min' => 1.25, 'max' => 1.75],
                'advanced' => ['min' => 1.75, 'max' => 2.5],
                'elite' => ['min' => 2.5, 'max' => 3],
            ],
        ];
    }
};
