<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Location extends Model
{
	protected $table = 'locations';

    public function houses(){
        return $this->hasMany('App\House');
    }

    public function estates(){
        return $this->hasMany('App\Estate');
    }
}
