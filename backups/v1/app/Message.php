<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Message extends Model
{
	protected $table = 'messages';

    public function sender(){
        return $this->belongsTo('App\Realtor', 'sender_id');
    }

    public function receiver(){
        return $this->belongsTo('App\Realtor', 'receiver_id');
    }

    public function related()
    {
    	if($this->related=='house') {
    		return $this->belongsTo('App\House', 'related_id');
    	}
    	if($this->related=='estate') {
    		return $this->belongsTo('App\Estate', 'related_id');
    	}
    }
}
