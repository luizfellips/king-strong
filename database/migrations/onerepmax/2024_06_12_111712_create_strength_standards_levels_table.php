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
            $table->float('min_ratio')->nullable();
            $table->float('max_ratio')->nullable();
            $table->char('gender')->nullable();

            $table->foreign('compound_id')->references('id')->on('compounds')->onDelete('cascade');
        });

        $this->insertDefaultRecords();
    }

    protected function insertDefaultRecords()
    {
        $compoundIds = [1, 2, 3];

        $trainingLevels = ['novice', 'beginner', 'intermediate', 'advanced', 'elite'];

        $maleRatioValues = $this->getMaleRatioValues();
        $femaleRatioValues = $this->getFemaleRatioValues();

        $maleStrengthStandards = $this->generateStrengthStandards($compoundIds, $trainingLevels, $maleRatioValues, 'M');
        $femaleStrengthStandards = $this->generateStrengthStandards($compoundIds, $trainingLevels, $femaleRatioValues, 'F');

        $this->seedStrengthStandards($maleStrengthStandards, $femaleStrengthStandards);
    }

    protected function seedStrengthStandards($maleStrengthStandards, $femaleStrengthStandards)
    {
        DB::table('strength_standards_levels')->insert(array_merge($maleStrengthStandards, $femaleStrengthStandards));
    }

    protected function generateStrengthStandards($compoundIds, $trainingLevels, $ratioValues, $gender)
    {
        $strengthStandards = [];

        foreach ($compoundIds as $compoundId) {
            foreach ($trainingLevels as $trainingLevel) {
                $yearsOfLifting = ($trainingLevel === 'novice') ? 'three_to_six_months' : $this->getTimeOfTraining($trainingLevel);

                $ratioValuesForCompound = $ratioValues[$compoundId][$trainingLevel] ?? ['min' => 1.0, 'max' => 1.0];
                $minRatio = $ratioValuesForCompound['min'];
                $maxRatio = $ratioValuesForCompound['max'];

                $strengthStandards[] = [
                    'compound_id' => $compoundId,
                    'training_level' => $trainingLevel,
                    'years_of_lifting' => $yearsOfLifting,
                    'min_ratio' => $minRatio,
                    'max_ratio' => $maxRatio,
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

    protected function getTimeOfTraining($trainingLevel)
    {
        switch ($trainingLevel) {
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
                'advanced' => ['min' => 1.5, 'max' => 2],
                'elite' => ['min' => 2, 'max' => 2.25],
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
