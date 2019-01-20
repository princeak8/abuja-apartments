<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Realtor_phone extends Model
{
	protected $table = 'abj_apartments.realtor_phones';

    public function Realtor(){
        return $this->belongsTo('App\Realtor', 'realtor_id');
    }
}
