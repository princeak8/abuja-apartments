<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House_photo extends Model
{
    // protected $table = 'abj_apartments.house_photos';

    public function scopeGetMainPhoto($query,$house_id)
    {
         return $query->where('house_id', $house_id)->where('main', '1');
    }

    public function scopeGetHousePhotos($query,$house_id)
    {
         return $query->where('house_id', $house_id);
    }

    public function house()
    {
        return $this->belongsTo('App\House');
    }

}
