<?php

namespace App\Models\Workouts\Program;

use App\Models\Workouts\Workout;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Week extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'workout_id',
        'week_number'
    ];

    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }

    public function days()
    {
        return $this->hasMany(Day::class);
    }
}
