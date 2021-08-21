<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    // id	user_id	order_id	date	car	location	location_name	status	car_plate	car_brand	carpark_add	mobile_number	created_at	updated_at
    protected $table    = 'booking';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'order_id',
        'date',
        'car',
        'price',
        'location',
        'location_name',
        'cancelrequest',
        'status',
        'car_plate',
        'car_brand',
        'carpark_add',
        'mobile_number'
    ];
}
