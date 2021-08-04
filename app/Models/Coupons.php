<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    use HasFactory;
    // id	name	discount	valide_date	created_at	updated_at

    protected $table    = 'coupons';
    protected $primaryKey = 'id';
    protected $fillable  = [
        'name',
        'discount',
        'valide_date'
    ];
}
