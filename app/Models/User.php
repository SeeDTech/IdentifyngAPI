<?php

namespace App\Models;
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

        'id',
        'first_name',
        'last_name',
        'middle_name',
        'gender',
        'dob',
        'state',
        'lga',
        'bvn',
        'phone',
        'role',
        'qrcode',
        'api_token',
        'address',
        'image'
    ];

    public function generateToken()
    {
        $this->api_token = str_random(60);
        $this->save();

        return $this->api_token;
    }

    public function thirdParties()
  	{
      	return $this->belongsToMany(ThirdParty::class);
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