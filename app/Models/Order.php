<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    // id	user_id	txn	price	referral_code	loyalty_point	auto_discount	created_at	updated_at

    //id	user_id	txn	price	referral_code	loyalty_point	auto_discount	created_at	updated_at
    protected $table    = 'orders';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'txn',
        'price',
        'referral_code',
        'loyalty_point',
        'auto_discount'
    ];
}
