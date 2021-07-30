<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use CommonFunction;

class CustomerProfile extends JsonResource
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
            'user_id'           => $this->user_id,
            'name'              => $this->name,
            'phone'             => $this->phone,
            'email'             => $this->email,
            // 'gender'            => $this->gender,
            // 'gender_name'       => array_search($this->user_gender,config('constant.GENDER')),
            // 'country_id'        => $this->country_id,
            // 'state_id'          => $this->state_id,
            // 'city_id'           => $this->city_id,
            // 'country_name'      => CommonFunction::GetSingleField('country','country_name','country_id',$this->country_id),
            // 'state_name'        => CommonFunction::GetSingleField('state','state_name','state_id',$this->state_id),
            // 'city_name'         => CommonFunction::GetSingleField('city','city_name','city_id',$this->city_id),
            // 'dob'               => $this->dob,
        ];
    }
}
