<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House_like extends Model
{
	public function scopeGetLike($query, $realtor_id, $house_id)
    {
        return $query->where('realtor_id', $realtor_id)->where('house_id', $house_id)->first();
    }

    public function scopeGetHouseLikes($query,$house_id)
    {
         return $query->where('house_id', $house_id);
    }

    public function house()
    {
        return $this->belongsTo('App\House');
    }

}
