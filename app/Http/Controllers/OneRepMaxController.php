<?php

namespace App\Http\Controllers;

use App\Models\Lifter;
use App\Models\Compound;
use Illuminate\Http\Request;
use App\Services\OneRepMaxService;
use App\Services\StrengthComparisonService;

class OneRepMaxController extends Controller
{
    protected $oneRepMaxService;
    protected $strengthComparisonService;

    public function __construct(OneRepMaxService $oneRepMaxService, StrengthComparisonService $strengthComparisonService)
    {
        $this->oneRepMaxService = $oneRepMaxService;
        $this->strengthComparisonService = $strengthComparisonService;
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
        $gender = $request->input('gender');

        if (!$height || !$weight || !$years_of_lifting) {
            return redirect()->route('onerepmax.step2')->with('error', 'Por favor preencha todos os campos.');
        }

        $lifter = Lifter::find($lifterId);
        $compounds = Compound::with('muscles')->get();

        if (!$lifter) {
            return redirect()->route('onerepmax.step1')->with('error', 'Lifter not found');
        }


        try {
            $lifter->update([
                'height' => $height,
                'weight' => $weight,
                'years_of_lifting' => $years_of_lifting,
                'gender' => $gender,
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
        $input = $this->validateInputs($request);

        $compound = Compound::findOrFail($input['compound_id']);
        $lifter = Lifter::findOrFail($input['lifter_id']);

        try {
            $this->oneRepMaxService->registerLifterRecord($lifter, $compound, $input);

            $strengthComparisonDetails = [];

            if($compound->id !== 4) {
                $strengthComparisonDetails = $this->strengthComparisonService->getFullDetails($lifter, $compound);
            }

            $oneRepMaxDetails = $this->oneRepMaxService->getFullDetails($lifter, $compound, $strengthComparisonDetails, $input);

            return view('onerepmax.finalStep', [
                'lifter' => $lifter,
                'compound' => $compound,
                ...$strengthComparisonDetails,
                ...$oneRepMaxDetails,
            ]);

        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage(), 1);
        }
    }

    private function validateInputs(Request $request)
    {
        return $request->validate([
            'compoundWeight' => 'required|numeric',
            'reps' => 'required|integer',
            'repsInReserve' => 'required|integer',
            'compound_id' => 'required|exists:compounds,id',
            'lifter_id' => 'required|exists:lifters,id',
        ]);
    }
}
