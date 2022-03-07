<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;
class ExternalBookResourseCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $release_date = Carbon::parse($this->collection['released']);
        $release_date = $release_date->toDateString();
        return [
            'name' => $this->collection['name'],
            'isbn' => $this->collection['isbn'],
            'authors' => $this->collection['authors'],
            'number_of_pages' => $this->collection['numberOfPages'],
            'publisher' => $this->collection['publisher'],
            'country' => $this->collection['country'],
            'release_date' => $release_date,
        ];
    }
}
