<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    use HasFactory;
   // id	name	address	postcode	capacity	map	created_at	updated_at


    protected $table    = 'locations';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'address',
        'postcode',
        'capacity',
        'map'
    ];

}
