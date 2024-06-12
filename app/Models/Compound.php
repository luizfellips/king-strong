<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compound extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'short_description',
        'image_path'
    ];

    public function muscles()
    {
        return $this->belongsToMany(Muscle::class, 'compound_muscles', 'compound_id', 'muscle_id');
    }

    public function lifterRecords()
    {
        return $this->hasMany(LifterRecord::class);
    }

    public function getLiftersWithRecords()
    {
        return $this->belongsToMany(Lifter::class, 'lifter_records');
    }
}
