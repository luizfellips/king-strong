<?php

namespace App\Models\Workouts\Program;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    protected $fillable = [
        'week_id', 'day_number',
    ];

    public function week()
    {
        return $this->belongsTo(Week::class);
    }

    public function dayExercises()
    {
        return $this->hasMany(DayExercise::class);
    }
}
