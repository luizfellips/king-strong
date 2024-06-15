<?php


namespace App\Http\Controllers;

use App\Models\Lifter;
use App\Models\Compound;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\OneRepMaxService;
use App\Http\Requests\LifterRequest;
use App\Http\Requests\RecordRequest;
use App\Services\StrengthComparisonService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        session()->forget('lifter');

        return view('onerepmax.step1');
    }

    public function processStep1(Request $request)
    {
        $input = $this->validateLifterName($request);

        $name = $input['name'];

        try {
            $lifter = Lifter::create(['name' => $name]);

            session()->put('lifter', $lifter->slug);

            return redirect()->route('onerepmax.step2', ['lifterSlug' => $lifter->slug]);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['Um Erro ocorreu ao registrar o levantador. Contate o suporte.']);
        }
    }

    private function checkCurrentLifter(Lifter $lifter)
    {
        if (!session()->has('lifter')) {
            return redirect()->route('onerepmax.step1');
        }

        if ($lifter->slug !== session()->get('lifter')) {
            $lifter = Lifter::where('slug', '=', session()->get('lifter'));
            $lifter->delete();

            return redirect()->route('onerepmax.step1')->withErrors(['Erro de Autorização.']);
        }
    }

    public function step2($lifterSlug)
    {
        $lifter = Lifter::where('slug', $lifterSlug)->firstOrFail();

        $redirect = $this->checkCurrentLifter($lifter);
        if ($redirect) {
            return $redirect;
        }

        return view('onerepmax.step2', ['lifter' => $lifter]);
    }

    public function processStep2(LifterRequest $request)
    {
        $input = $request->validated();

        $lifterSlug = $input['lifter_slug']; // Retrieve slug from input
        $height = $input['height'];
        $weight = $input['weight'];
        $years_of_lifting = $input['years_of_lifting'];
        $gender = $input['gender'];

        $lifter = Lifter::where('slug', $lifterSlug)->firstOrFail();

        try {
            $lifter->update([
                'height' => $height,
                'weight' => $weight,
                'years_of_lifting' => $years_of_lifting,
                'gender' => $gender,
            ]);

            return redirect()->route('onerepmax.step3', ['lifterSlug' => $lifter->slug]);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred while updating the lifter.']);
        }
    }

    public function step3($lifterSlug)
    {
        $lifter = Lifter::where('slug', $lifterSlug)->firstOrFail();
        $redirect = $this->checkCurrentLifter($lifter);

        if ($redirect) {
            return $redirect;
        }

        $compounds = Compound::with('muscles')->get();
        return view('onerepmax.step3', ['lifter' => $lifter, 'compounds' => $compounds]);
    }

    public function processStep3(Request $request)
    {
        $compoundSlug = $request->input('compound_slug');
        $lifterSlug = $request->input('lifter_slug');

        return redirect()->route('onerepmax.step4', ['lifterSlug' => $lifterSlug, 'compoundSlug' => $compoundSlug]);
    }

    public function step4($lifterSlug, $compoundSlug)
    {
        $lifter = Lifter::where('slug', $lifterSlug)->firstOrFail();
        $compound = Compound::where('slug', $compoundSlug)->firstOrFail();
        $redirect = $this->checkCurrentLifter($lifter);

        if ($redirect) {
            return $redirect;
        }

        return view('onerepmax.step4', ['lifter' => $lifter, 'compound' => $compound]);
    }

    public function processStep4(RecordRequest $request)
    {
        $input = $request->validated();

        $compoundSlug = $input['compound_slug']; // Retrieve slug from input
        $lifterSlug = $input['lifter_slug']; // Retrieve slug from input

        $compound = Compound::where('slug', $compoundSlug)->firstOrFail();
        $lifter = Lifter::where('slug', $lifterSlug)->firstOrFail();

        try {
            $this->oneRepMaxService->registerLifterRecord($lifter, $compound, $input);
            session(['input' => $input]);

            return redirect()->route('onerepmax.finalStep', [
                'lifterSlug' => $lifter->slug,
                'compoundSlug' => $compound->slug,
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred while registering the lifter record.']);
        }
    }

    public function finalStep($lifterSlug, $compoundSlug)
    {
        $lifter = Lifter::where('slug', $lifterSlug)->firstOrFail();
        $compound = Compound::where('slug', $compoundSlug)->firstOrFail();
        $redirect = $this->checkCurrentLifter($lifter);

        if ($redirect) {
            return $redirect;
        }

        session()->forget('lifter');
        $input = session('input', []);

        $strengthComparisonDetails = [];

        if ($compound->id !== 4) {
            $strengthComparisonDetails = $this->strengthComparisonService->getFullDetails($lifter, $compound);
        }

        $oneRepMaxDetails = $this->oneRepMaxService->getFullDetails($lifter, $compound, $strengthComparisonDetails, $input);

        return view('onerepmax.finalStep', [
            'lifter' => $lifter,
            'compound' => $compound,
            ...$strengthComparisonDetails,
            ...$oneRepMaxDetails,
        ]);
    }

    private function validateLifterName(Request $request)
    {
        return $request->validate([
            'name' => [
                'required',
                'string',
                'min:2',
                'max:255',
                'regex:/^[a-zA-ZÀ-ÿ\s]+$/'
            ]
        ], [
            'name.required' => 'O nome é obrigatório.',
            'name.string' => 'O nome deve ser um texto.',
            'name.min' => 'O nome deve ter pelo menos 2 caracteres.',
            'name.max' => 'O nome deve ter no máximo 255 caracteres.',
            'name.regex' => 'O nome deve conter apenas letras e espaços.',
        ]);
    }
}
