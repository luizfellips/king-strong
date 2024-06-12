<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LifterRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'compound_id',
        'lifter_id',
        'one_rep_max'
    ];

    public function lifter()
    {
        return $this->belongsTo(Lifter::class);
    }

    public function compound()
    {
        return $this->belongsTo(Compound::class);
    }
}
