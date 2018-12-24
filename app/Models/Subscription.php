<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    //
    protected $fillable = [
        'id',
        'sub_type',
        'amount',
    ];

	/**
	 * An answer has many solutions
	 * @return Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function thirdParties()
	{
		return $this->hasMany(ThirdParty::class);
	}

}
