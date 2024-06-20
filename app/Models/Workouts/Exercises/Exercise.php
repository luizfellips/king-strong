<?php

namespace App\Models\Workouts\Exercises;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function targetMuscles()
    {
        return $this->belongsToMany(TargetMuscle::class, 'exercise_target_muscles', 'exercise_id', 'target_muscle_id');
    }
}
