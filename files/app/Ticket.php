<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Ticket extends Model
{
    public function getStatusAttribute()
    {
        if($this->ticket_status==1) {
            return 'RESOLVED';
        }else{
            return 'PENDING';
        }
    }

    public function getCreatedAttribute()
    {
        $time = strtotime($this->created_at);
        return date("jS M Y", $time);
    }

    public function scopeResolved($query){
        return $query->where('status', 0);
    }
    public function scopeUnresolved($query){
        return $query->where('status', 1);
    }
    
    public function realtor(){
        return $this->belongsTo('App\Realtor', 'realtor_id');
    }
    
}
