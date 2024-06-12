<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrengthStandardsLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'compound_id',
        'training_level',
        'years_of_lifting',
        'min_ratio',
        'max_ratio',
        'gender',
    ];
}
