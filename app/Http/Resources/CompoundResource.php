<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompoundResource extends JsonResource
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
            'shortDescription' => $this->short_description,
            'imagePath' => $this->image_path,
            'slug' => $this->slug,
            'muscles' => $this->muscles->pluck('name'),
        ];
    }
}
