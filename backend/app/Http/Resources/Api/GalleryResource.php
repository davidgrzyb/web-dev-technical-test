<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Api\PhotoResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GalleryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // The photos should not load unless the relationship is loaded.
        // This resource is separate from the GalleryResource as the separation
        // should be distinct between a Gallery and a Photo, despite a Gallery
        // only being filled with Photo's in this case.
        if (! $this->relationLoaded('photos')) {
            return [];
        }

        return PhotoResource::collection($this->whenLoaded('photos'));
    }
}
