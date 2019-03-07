<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Realtor_phone extends Model
{
    protected $fillable = ['phone', 'realtor_id'];
    
    public function Realtor(){
        return $this->belongsTo('App\Realtor', 'realtor_id');
    }
}
