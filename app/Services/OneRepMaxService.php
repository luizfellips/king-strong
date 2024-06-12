<?php

namespace App\Services;

class OneRepMaxService {
    public function getWeightChart($total, $reps, $repsInReserve)
    {
        $possibleReps = $reps + $repsInReserve;
        $oneRepMax = $this->getOneRepMax($total, $possibleReps);
        $weights = $this->calculateWeights($oneRepMax);
        return $weights;
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

    protected function getOneRepMax($total, $possibleReps)
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
