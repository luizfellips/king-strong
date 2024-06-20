<?php

namespace App\Models\Workouts;

use App\Models\Workouts\Program\Week;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Workout extends Model
{
    use HasFactory;

    protected $fillable = [
        'workout_id',
        'name',
        'description',
        'length_in_weeks',
        'workouts_per_week',
        'minutes_per_workout',
    ];

    public function levels()
    {
        return $this->belongsToMany(Level::class, 'workout_levels', 'workout_id', 'level_id');
    }

    public function goals()
    {
        return $this->belongsToMany(Goal::class, 'workout_goals', 'workout_id', 'goal_id');
    }

    public function weeks()
    {
        return $this->hasMany(Week::class);
    }
}
