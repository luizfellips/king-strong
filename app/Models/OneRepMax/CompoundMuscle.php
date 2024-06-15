<?php

namespace App\Models\OneRepMax;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompoundMuscle extends Model
{
    use HasFactory;
    protected $fillable = [
        'compound_id',
        'muscle_id',
    ];
}
