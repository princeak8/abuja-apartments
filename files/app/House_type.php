<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class House_type extends Model
{
    public function scopeGetHouseByType($query,$type){
        return $query->where('type','=',$type)->first();
    }

    public function houses(){
        return $this->hasMany('App\House','house_type_id');
    }
}
