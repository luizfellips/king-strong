<?php

namespace App\Models\Workouts\Program;

use Illuminate\Database\Eloquent\Model;
use App\Models\Workouts\Exercises\Exercise;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DayExercise extends Model
{
    use HasFactory;

    protected $fillable = ['day_id', 'exercise_id', 'sets', 'reps', 'rpe'];

    public function day()
    {
        return $this->belongsTo(Day::class);
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}
