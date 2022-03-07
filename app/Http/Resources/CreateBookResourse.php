<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CreateBookResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'book' => [
                'name' => $this->name,
                'isbn' => $this->isbn,
                'authors' => $this->authors,
                'number_of_pages' => $this->number_of_pages,
                'country' => $this->country,
                'release_date' => $this->release_date,
            ],
        ];
    }
}
