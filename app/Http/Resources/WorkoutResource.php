<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkoutResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'lengthInWeeks' => $this->length_in_weeks,
            'workoutsPerWeek' => $this->workouts_per_week,
            'minutesPerWorkout' => $this->minutes_per_workout,
            'levels' => $this->levels->pluck('name'),
            'goals' => $this->goals->pluck('name'),
        ];
    }
}
