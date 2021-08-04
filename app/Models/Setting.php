<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    // id	currency	payment_key_1	payment_key_2	car_price_1	car_price_2	car_price_3	auto_discount_1	auto_discount_percent_1	auto_discount_2	auto_discount_percent_2	loyalty_point_discount	created_at	updated_at
    protected $table    = 'setting';
    protected $primaryKey = 'id';
    protected $fillable  = [
        'currency',
        'payment_key_1',
        'payment_key_2',
        'car_price_1',
        'car_price_2',
        'car_price_3',
        'car_trial_price_1',
        'car_trial_price_2',
        'car_trial_price_3',
        'auto_discount_1',
        'auto_discount_percent_1',
        'auto_discount_2',
        'auto_discount_percent_2',
        'loyalty_point_discount',
    ];
}
