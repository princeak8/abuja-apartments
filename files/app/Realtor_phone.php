<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Realtor_phone extends Model
{
    public function Realtor(){
        return $this->belongsTo('App\Realtor', 'realtor_id');
    }
}
