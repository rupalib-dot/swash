<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsedCoupon extends Model
{
    use HasFactory;
    protected $table    = 'usedcoupon';
    protected $primaryKey = 'id';
    protected $fillable  = [
        'coupon_id',
        'user_id',
    ];
}
