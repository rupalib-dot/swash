<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blackout extends Model
{
    use HasFactory;
    // 	id	startdate	enddate	location	created_at	updated_at

    protected $table    = 'blackout';
    protected $primaryKey = 'id';

    protected $fillable = [
        'startdate',
        'enddate',
        'location',
    ];
}
