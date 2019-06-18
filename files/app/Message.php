<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Message extends Model
{
    public function scopeRead($query){
        return $query->where('unread', 0);
    }
    public function scopeUnread($query){
        return $query->where('unread', 1);
    }
    
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
