<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class City extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'city_id'       => $this->city_id,
            'city_name'     => $this->city_name,
        ];
    }
}
