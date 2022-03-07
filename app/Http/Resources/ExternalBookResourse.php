<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Log;

class ExternalBookResourse extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $released_date = Carbon::parse($this->collection['released']);
        $released_date = $released_date->toDateString();
        return [
            'name' => $this->collection['name'],
            'isbn' => $this->collection['isbn'],
            'authors' => $this->collection['authors'],
            'number_of_pages' => $this->collection['numberOfPages'],
            'publisher' => $this->collection['publisher'],
            'country' => $this->collection['country'],
            'release_date' => $released_date,
        ];
    }
}
