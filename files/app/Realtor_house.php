<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Realtor_house extends Model
{
	// protected $table = 'abj_apartments.realtor_houses';

    public function house(){
        return $this->belongsTo('App\House', 'house_id');
    }

    public function realtor(){
        return $this->belongsTo('App\Realtor', 'realtor_id');
    }

    public function sharer(){
        return $this->belongsTo('App\Realtor', 'sharer_id');
    }

}
