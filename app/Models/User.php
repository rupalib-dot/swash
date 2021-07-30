<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Roles; 

class User extends Authenticatable
{
    use SoftDeletes;
    use HasFactory, Notifiable;

    protected $table    = 'users';
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'image',
        'name',
        'phone',
        'email',
        'email_status',
        'phone_status',  
        'user_code',
        'gender',
        'country_id',
        'state_id',
        'city_id',
        'dob', 
        'address',
        'password',  
    ];

    protected $dates = [ 'deleted_at' ];

    public function user_role()
    {
        return $this->hasOne('App\Models\UserRole','user_id');
    }

    public function login_account($email_address, $user_password, &$user_data)
    {
        $user_status    = False;
        $user_data      = User::with('user_role')
        ->Where(function ($query) use ($email_address) {
            $query->where('email',$email_address)
                  ->orWhere('phone',$email_address);
        })
        ->where('password',$user_password)->first(); 
        if(isset($user_data))
        {
            $user_status = True;
        }
        return $user_status;
    }

    public function pass_exist($user_id, $user_password, &$user_data)
    {
        $user_status    = False;
        $user_data      = User::Where('user_id',$user_id)->Where('password',$user_password)->first();
        if(isset($user_data))
        {
            $user_status = True;
        }
        return $user_status;
    }
  
    public function user_list($user_code, $name)
    {  
        return User::Where(function($query) use ($user_code, $name) {
                if (isset($user_code) && !empty($user_code)) {
                    $query->where('user_code', 'LIKE', "%".$user_code."%");
                }
                if (isset($name) && !empty($name)) {
                    $query->where('name', 'LIKE', "%".$name."%");
                }
                if (isset($nationality_id) && !empty($nationality_id)) {
                    $query->where('country_id',$nationality_id);
                }  
            })->orderBy('name','desc')->paginate(10);
    }
}
