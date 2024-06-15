<?php

namespace App\Services\OneRepMax;

use App\Models\OneRepMax\LifterRecord;


class OneRepMaxService
{
    protected $strengthComparisonService;

    public function __construct(StrengthComparisonService $strengthComparisonService) {
        $this->strengthComparisonService = $strengthComparisonService;
    }
    public function getFullDetails($lifter, $compound, $strengthComparisonDetails, $input)
    {
        $example = [];
        
        if (!empty($strengthComparisonDetails)) {
            $example = $this->getExample($lifter->gender, $strengthComparisonDetails['standards']['minRatio'], $strengthComparisonDetails['standards']['maxRatio']);
        }

        $oneRepMax = $this->getOneRepMax($input['compoundWeight'], $input['reps'] + $input['repsInReserve']);
        $weightRatio = $this->getRatio($lifter, $oneRepMax);

        $results = $this->getWeightChart($input['compoundWeight'], $input['reps'], $input['repsInReserve']);
        $percentOfRelativeIntensity = $this->getPercentOfRelativeIntensity($input['reps'], $input['repsInReserve']);

        $trainingLevel = $this->strengthComparisonService->getTrainingLevel($lifter, $compound);
        
        return [
            'example' => $example,
            'oneRepMax' => $oneRepMax,
            'weightRatio' => $weightRatio,
            'results' => $results,
            'percentOfRelativeIntensity' => $percentOfRelativeIntensity,
            'trainingLevel' => $trainingLevel,

        ];
    }
    public function getWeightChart($total, $reps, $repsInReserve)
    {
        $possibleReps = $reps + $repsInReserve;
        $oneRepMax = $this->getOneRepMax($total, $possibleReps);
        $weights = $this->calculateWeights($oneRepMax);
        return $weights;
    }

    public function getRatio($lifter, $oneRepMax)
    {
        return $oneRepMax / $lifter->weight;
    }

    public function getExample($gender, $minRatio, $maxRatio)
    {
        $weight = ($gender == 'M') ? 80 : (($gender == 'F') ? 60 : null);

        if ($weight === null) {
            return "Invalid gender specified.";
        }

        $total1 = $weight * $minRatio;
        $total2 = $weight * $maxRatio;

        return [
            $weight => [$total1, $total2],
        ];
    }

    public function registerLifterRecord($lifter, $compound, $input)
    {
        $lifterRecord = LifterRecord::find($lifter->id, ['lifter_id']);
        $compoundTotal = $input['compoundWeight'];
        $reps = $input['reps'];
        $repsInReserve = $input['repsInReserve'];
        $possibleReps =  $input['reps'] + $input['repsInReserve'];
        $oneRepMax = $this->getOneRepMax($compoundTotal, $possibleReps);
        $trainingLevel = $this->strengthComparisonService->calculateTrainingLevel($oneRepMax, $compound, $lifter->weight, $lifter->gender);

        if ($lifterRecord) {
            return;
        }

        LifterRecord::create([
            'lifter_id' => $lifter->id,
            'compound_id' => $compound->id,
            'one_rep_max' => $oneRepMax,
            'reps' => $reps,
            'reps_in_reserve' => $repsInReserve,
            'compound_total' => $compoundTotal,
            'training_level' => $trainingLevel, 
        ]);
    }

    protected function calculateWeights($oneRepMax)
    {
        $weights = [];

        $ranges = [
            ["start" => 100, "end" => 95, "decrement" => 5],
            ["start" => 95, "end" => 75, "decrement" => 2.5],
            ["start" => 75, "end" => 70, "decrement" => 5],
            ["start" => 70, "end" => 65, "decrement" => 2.5],
        ];

        foreach ($ranges as $range) {
            $weights = $this->calculateWeightsInRange($oneRepMax, $range["start"], $range["end"], $range["decrement"], $weights);
        }

        return $weights;
    }

    protected function calculateWeightsInRange($oneRepMax, $startPercent, $endPercent, $decrement, $weights)
    {
        $percentages = range($startPercent, $endPercent, -$decrement);

        foreach ($percentages as $percent) {
            $estimatedWeight = ($percent / 100) * $oneRepMax;
            $weights[number_format($percent, 1)] = round($estimatedWeight) - 2;
        }

        return $weights;
    }

    public function getOneRepMax($total, $possibleReps)
    {
        // Epley formula
        return $total * (1 + 0.0333 * $possibleReps);
    }

    public function getPercentOfRelativeIntensity($reps, $repsInReserve)
    {
        $possibleReps = $reps + $repsInReserve;
        $percentOfRelativeIntensity = $possibleReps === 1 ? 100 : 100 - ($possibleReps * 2.5);

        return $percentOfRelativeIntensity;
    }
}
