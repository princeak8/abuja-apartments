<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House_comment extends Model
{

    public function scopeGetHouseComments($query,$house_id)
    {
         return $query->where('house_id', $house_id);
    }

    public function house()
    {
        return $this->belongsTo('App\House');
    }

    public function realtor()
    {
        return $this->belongsTo('App\Realtor');
    }

}
