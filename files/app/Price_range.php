<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Price_range extends Model
{
    public function houses(){
        return $this->hasMany('App\House');
    }
}
