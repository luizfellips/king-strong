<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workouts\Goal;
use App\Models\Workouts\Level;
use App\Models\Workouts\Exercises\Exercise;
use App\Models\Workouts\Workout as Workout;

class WorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $levels = Level::all();
        $goals = Goal::all();
        $workouts = Workout::with(['levels', 'goals'])->paginate(4);

        return view('workout.index', compact('levels', 'goals', 'workouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Workout $workout)
    {
        $workout = Workout::where('id', $workout->id)->with(['levels', 'goals', 'weeks.days.dayExercises.exercise'])->firstOrFail();
        $levels = $workout->levels->pluck('name')->implode(', ');
        $goals = $workout->goals->pluck('name')->implode(', ');

        return view('workout.show', ['workout' => $workout, 'levels' => $levels, 'goals' => $goals]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Workout $workout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Workout $workout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workout $workout)
    {
        //
    }
}
