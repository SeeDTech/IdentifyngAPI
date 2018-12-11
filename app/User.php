<?php

namespace App;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'user_id',
        'lname',
        'sname',
        'mname',
        'email',
        'gender',
        'dob',
        'state',
        'lga',
        'bvn',
        'phone',
        'qrcode',
        'password',
        'user_token',
        'role',
        'image',
        'address'
    ];

     public function generateToken()
    {
        $this->user_token = str_random(60);
        $this->save();

        return $this->user_token;
    }

    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    
}
