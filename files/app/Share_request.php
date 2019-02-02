<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Share_request extends Model
{
	// protected $table = 'abj_apartments.share_requests';

    public function house(){
        return $this->belongsTo('App\House', 'house_id');
    }

    public function sharer(){
        return $this->belongsTo('App\Realtor', 'sharer_id');
    }

    public function shared(){
        return $this->belongsTo('App\Realtor', 'shared_id');
    }

}
