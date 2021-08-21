<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralCoupon extends Model
{
    use HasFactory;
    // id	user_id	coupon	created_at	updated_at
    protected $table    = 'referral_coupon';
    protected $primaryKey = 'id';
    protected $fillable  = [
        'user_id',
        'coupon',
    ];
}
