<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Price_range extends Model
{
	protected $table = 'abj_apartments.price_ranges';

    public function houses(){
        return $this->hasMany('App\House');
    }
}
