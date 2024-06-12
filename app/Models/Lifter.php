<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lifter extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'height',
        'weight',
        'years_of_lifting'
    ];

    public function lifterRecord()
    {
        return $this->hasOne(LifterRecord::class);
    }

    public function getOneRepMaxForCompound($compoundId)
    {
        return $this->lifterRecord()->where('compound_id', $compoundId)->first();
    }
}
