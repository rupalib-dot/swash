<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    // id	user_id	location	car_type	date
    protected $table    = 'cart';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'location',
        'location_name',
        'car',
        'price',
        'date',
        'car_plate',
        'car_brand',
        'carpark_add',
        'mobile_number'

    ];
}
