<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThirdParty extends Model
{
    //
    protected $fillable = [
        'id',
        'name',
        'code',
        'phone',
        'image',
        'subscription_id'
    ];

    public function question()
	{
		return $this->belongsTo(Subscription::class);
    }
    
    public function users()
  	{
      	return $this->belongsToMany(User::class);
  	}
}
