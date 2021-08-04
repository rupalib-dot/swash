<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table    = 'users';
    protected $primaryKey = 'id';
    protected $fillable  = [
        'role',
        'name',
        'token',
        'verify',
        'phone',
        'status',
        'email',
        'photo',
        'password'
    ];
    public function checkUser($email, $password)
    {
        $row = User::Where('email',$email)->Where('password',$password)->first();
        return $row;
    }
    public function userDetails($userID){
        $row = User::where('id', $userID)->first();
        return $row;
    }
}
