<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estate_photo extends Model
{

    public function scopeGetMainPhoto($query,$estate_id)
    {
         return $query->where('estate_id', $estate_id)->where('main', '1');
    }

    public function scopeGetEstatePhotos($query,$estate_id)
    {
         return $query->where('estate_id', $estate_id);
    }

    public function estate()
    {
        return $this->belongsTo('App\Estate');
    }

}
