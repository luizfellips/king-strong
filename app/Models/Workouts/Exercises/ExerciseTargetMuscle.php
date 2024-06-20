<?php

namespace App\Models\Workouts\Exercises;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseTargetMuscle extends Model
{
    use HasFactory;

    protected $fillable = [
        'exercise_id',
        'target_muscle_id',
    ];
}
