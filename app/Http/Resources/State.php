<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class State extends JsonResource
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
            'state_id'       => $this->state_id,
            'state_name'     => $this->state_name,
        ];
    }
}
