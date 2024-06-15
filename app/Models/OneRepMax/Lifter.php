<?php

namespace App\Models\OneRepMax;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lifter extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'height',
        'weight',
        'years_of_lifting',
        'gender',
        'slug'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($lifter) {
            $lifter->slug = $lifter->generateUniqueSlug($lifter->name);
        });
    }

    protected function generateUniqueSlug($name, $lifterId = null)
    {
        $slug = Str::slug($name);
        $newSlug = $slug;
        $counter = 1;

        // Check if a lifter with the same slug already exists
        while (Lifter::where('slug', $newSlug)->where('id', '<>', $lifterId)->exists()) {
            $newSlug = $slug . '-' . $counter;
            $counter++;
        }

        return $newSlug;
    }



    public function lifterRecord()
    {
        return $this->hasOne(LifterRecord::class);
    }

    public function getLifterRecordForCompound($compoundId)
    {
        return $this->lifterRecord()->where('compound_id', $compoundId)->first();
    }
}
