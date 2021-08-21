<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reschedule extends Model
{
    use HasFactory;
    // id	user_id	booking_id	date	another_date	status	created_at	updated_at
    protected $table    = 'reschedule';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'booking_id',
        'date',
        'another_date',
        'status'
    ];
}
