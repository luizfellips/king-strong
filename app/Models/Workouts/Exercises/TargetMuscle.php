<?php

namespace App\Models\Workouts\Exercises;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetMuscle extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class, 'exercise_target_muscles', 'target_muscle_id', 'exercise_id');
    }
}
