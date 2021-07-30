<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Authenticatable
{
    use SoftDeletes;
    use HasFactory, Notifiable;

    protected $table    = 'city';
    protected $primaryKey = 'city_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'state_id',
        'city_name',
    ];

    protected $dates = [ 'deleted_at' ];
}
