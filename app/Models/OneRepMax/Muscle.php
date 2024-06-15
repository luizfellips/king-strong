<?php

namespace App\Models\OneRepMax;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Muscle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
