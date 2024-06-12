<?php

namespace App\Services;

use App\Models\LifterRecord;

class OneRepMaxService
{
    public function getWeightChart($total, $reps, $repsInReserve)
    {
        $possibleReps = $reps + $repsInReserve;
        $oneRepMax = $this->getOneRepMax($total, $possibleReps);
        $weights = $this->calculateWeights($oneRepMax);
        return $weights;
    }

    public function getRatio($lifter, $oneRepMax) {
        return $oneRepMax / $lifter->weight;
    }

    public function getExample($minRatio, $maxRatio) {
        $weight = 80;
        $total1 = $weight * $minRatio;
        $total2 = $weight * $maxRatio;

        return [
            $weight => [$total1, $total2],
        ];
    }

    public function registerLifterRecord($lifter, $compound, $total, $reps)
    {
        $lifterRecord = LifterRecord::find($lifter->id, ['lifter_id']);

        if ($lifterRecord) {
            return;
        }

        $oneRepMax = $this->getOneRepMax($total, $reps);

        LifterRecord::create([
            'lifter_id' => $lifter->id,
            'compound_id' => $compound->id,
            'one_rep_max' => $oneRepMax,
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
