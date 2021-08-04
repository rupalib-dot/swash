<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    use HasFactory;
    // id	name	email	phone	address	postcode	photo	location	created_at	updated_at
    protected $table    = 'teams';
    protected $primaryKey = 'id';
    protected $fillable  = [
        'name',
        'email',
        'phone',
        'address',
        'postcode',
        'photo',
        'location',
    ];
}
