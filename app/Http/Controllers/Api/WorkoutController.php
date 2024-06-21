<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Workouts\Workout;
use App\Http\Controllers\Controller;
use App\Http\Resources\WorkoutCollection;
use App\Http\Resources\WorkoutResource;

class WorkoutController extends Controller
{
    public function index(Request $request)
    {
        // Get filter parameters from the request
        $levelIds = $request->input('levels');
        $goalIds = $request->input('goals');   
        $workoutsPerWeek = $request->input('workouts_per_week'); 
        $query = Workout::with(['levels', 'goals']);

        if ($levelIds) {
            $query->whereHas('levels', function ($query) use ($levelIds) {
                $query->whereIn('levels.id', $levelIds);
            });
        }

        if ($goalIds) {
            $query->whereHas('goals', function ($query) use ($goalIds) {
                $query->whereIn('goals.id', $goalIds);
            });
        }

        if ($workoutsPerWeek) {
            if (!is_array($workoutsPerWeek)) {
                $workoutsPerWeek = [$workoutsPerWeek];
            }
            $query->whereIn('workouts_per_week', $workoutsPerWeek);
        }

        $workouts = $query->get();


        return new WorkoutCollection($workouts);
    }

    /**
     * Display the specified resource.
     */
    public function show(Workout $workout)
    {
        $workout->load(['levels', 'goals']); // Eager load the muscles relationship
        return new WorkoutResource($workout);
    }
}
