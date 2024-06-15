<?php

namespace App\Models\OneRepMax;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Compound extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'short_description', 'image_path', 'slug'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($compound) {
            $compound->slug = $compound->generateUniqueSlug($compound->name);
        });

        static::updating(function ($compound) {
            $compound->slug = $compound->generateUniqueSlug($compound->name);
        });
    }

    protected function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $count = Compound::where('slug', $slug)->where('id', '!=', $this->id)->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }


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
