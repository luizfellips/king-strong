<?php

namespace App\Http\Controllers;

use App\Models\Lifter;
use App\Models\Compound;
use Illuminate\Http\Request;

class OneRepMaxController extends Controller
{
    public function step1()
    {
        return view('onerepmax.step1');
    }

    public function step2(Request $request)
    {
        $name = $request->input('name');

        if (!$name) {
            return redirect()->route('onerepmax.step1')->with('error', 'Name is required');
        }

        try {
            $lifter = Lifter::create(['name' => $name]);


            return view('onerepmax.step2', ['lifter' => $lifter]);
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage(), $th->getCode());
        }
    }

    public function step3(Request $request)
    {
        $lifterId = $request->input('lifter_id');
        $height = $request->input('height');
        $weight = $request->input('weight');

        $lifter = Lifter::find($lifterId);
        $compounds = Compound::with('muscles')->get();

        if (!$lifter) {
            return redirect()->route('onerepmax.step1')->with('error', 'Lifter not found');
        }

        // Save the lifter to the database
        try {
            $lifter->update([
                'height' => $height,
                'weight' => $weight,
            ]);

            return view('onerepmax.step3', ['lifter' => $lifter, 'compounds' => $compounds]);
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage(), $th->getCode());
        }
    }

    public function step4(Request $request)
    {
        $compound = Compound::find($request->input('compound_id'));
        return view('onerepmax.step4', ['compound' => $compound]);
    }

    public function process(Request $request)
    {
        $total = $request->input('compoundWeight');
        $reps = $request->input('reps');
        $repsInReserve = $request->input('repsInReserve');

        return view('onerepmax.finalStep', [
            'results' => $this->calculateResults($total, $reps, $repsInReserve),
            'percentOfRelativeIntensity' => $this->getPercentOfRelativeIntensity($reps, $repsInReserve),
        ]);
    }

    protected function getPercentOfRelativeIntensity($reps, $repsInReserve)
    {
        $possibleReps = $reps + $repsInReserve;
        $percentOfRelativeIntensity = $possibleReps === 1 ? 100 : 100 - ($possibleReps * 2.5);

        return $percentOfRelativeIntensity;
    }

    protected function calculateResults($total, $reps, $repsInReserve)
    {
        $possibleReps = $reps + $repsInReserve;
        $oneRepMax = $this->calculateOneRepMax($total, $possibleReps);
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

    protected function calculateOneRepMax($total, $possibleReps)
    {
        // Epley formula
        return $total * (1 + 0.0333 * $possibleReps);
    }
}
