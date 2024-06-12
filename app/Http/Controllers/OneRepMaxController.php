<?php

namespace App\Http\Controllers;

use App\Models\Lifter;
use App\Models\Compound;
use App\Models\LifterRecord;
use Illuminate\Http\Request;
use App\Services\OneRepMaxService;
use App\Models\StrengthStandardsLevel;
use Ramsey\Uuid\Type\Integer;

class OneRepMaxController extends Controller
{
    protected $oneRepMaxService;

    public function __construct(OneRepMaxService $oneRepMaxService)
    {
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
            return redirect()->route('onerepmax.step1')->with('error', 'Insira seu nome!');
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
        $years_of_lifting = $request->input('years_of_lifting');

        if (!$height || !$weight || !$years_of_lifting) {
            return redirect()->route('onerepmax.step2')->with('error', 'Por favor preencha todos os campos.');
        }

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
                'years_of_lifting' => $years_of_lifting,
            ]);

            return view('onerepmax.step3', ['lifter' => $lifter, 'compounds' => $compounds]);
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage(), $th->getCode());
        }
    }

    public function step4(Request $request)
    {
        $compound = Compound::find($request->input('compound_id'));
        $lifter = Lifter::find($request->input('lifter_id'));

        return view('onerepmax.step4', ['lifter' => $lifter, 'compound' => $compound]);
    }

    public function process(Request $request)
    {
        $total = $request->input('compoundWeight');
        $reps = $request->input('reps');
        $repsInReserve = $request->input('repsInReserve');
        $compound = Compound::find($request->input('compound_id'));
        $lifter = Lifter::find($request->input('lifter_id'));

        $results = $this->oneRepMaxService->getWeightChart($total, $reps, $repsInReserve);
        $percentOfRelativeIntensity = $this->oneRepMaxService->getPercentOfRelativeIntensity($reps, $repsInReserve);
        try {
            $this->oneRepMaxService->registerLifterRecord($lifter, $compound, $total, $reps + $repsInReserve);
            
            return view('onerepmax.finalStep', [
                'results' => $results,
                'percentOfRelativeIntensity' => $percentOfRelativeIntensity,
            ]);
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage(), 1);
        }
    }
}
