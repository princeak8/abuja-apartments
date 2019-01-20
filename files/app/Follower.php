<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Follower extends Model
{
	protected $table = 'abj_apartments.followers';

	public function scopeGetFollow($query, $realtor_id, $follower_id)
    {
        return $query->where('realtor_id', $realtor_id)->where('follower_id', $follower_id)->first();
    }
}
