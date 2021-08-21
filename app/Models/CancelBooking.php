<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelBooking extends Model
{
    use HasFactory;
    // id	user_id	booking_id	status	created_at	updated_at
    protected $table    = 'cancel_request';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'booking_id',
        'status'
    ];
}
