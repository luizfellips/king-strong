<?php

namespace App\Http\Controllers;

use App\Models\Lifter;
use App\Models\Compound;
use App\Models\StrengthStandardsLevel;
use App\Services\OneRepMaxService;
use Illuminate\Http\Request;

class OneRepMaxController extends Controller
{
    protected $oneRepMaxService;

    public function __construct(OneRepMaxService $oneRepMaxService) {
        $this->oneRepMaxService = $oneRepMaxService;
    }

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

        $results = $this->oneRepMaxService->calculateResults($total, $reps, $repsInReserve);
        $percentOfRelativeIntensity = $this->oneRepMaxService->getPercentOfRelativeIntensity($reps, $repsInReserve);

        return view('onerepmax.finalStep', [
            'results' => $results,
            'percentOfRelativeIntensity' => $percentOfRelativeIntensity,
        ]);
    }

}
