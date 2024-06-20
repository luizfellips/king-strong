<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workouts\Exercises\Exercise;
use App\Models\Workouts\Workout as Workout;

class WorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workouts = Workout::with(['levels','goals','weeks.days.dayExercises.exercise.targetMuscles'])->paginate(6);

        $exercises = Exercise::with('targetMuscles')->get();

        return view('workout.index', compact('workouts', 'exercises'));
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
        //
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
