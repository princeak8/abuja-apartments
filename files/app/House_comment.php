<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House_comment extends Model
{
    // protected $table = 'abj_apartments.house_comments';

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
