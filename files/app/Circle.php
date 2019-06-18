<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Circle extends Model
{
    /*
        Status Assignments
        0  = Friend Request Sent(Pending)
        1  = Friend Request Accepted
        -1 = Friend Request Rejected
    */

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('D, jS M Y');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('D, jS M Y');
    }

    public function userOne()
    {
    	return $this->belongsTo('App\Realtor', 'user_one', 'id');
    }

    public function userTwo()
    {
        return $this->belongsTo('App\Realtor', 'user_two', 'id');
    }

    public function action_user()
    {
        return $this->belongsTo('App\Realtor', 'action_user', 'id');
    }

    public function scopeGetCircle($query, $id)
    {
        return $query->where('user_one', $id)->orWhere('user_two', $id)->where('status', '1');
    }

    public function scopeCircleRequests($query, $id)
    {
        return $query->where('user_one', $id)->orWhere('user_two', $id)->where('status', '0')->where('action_user', '!=', $id)->get();
    }

    public function scopeSentRequests($query, $id)
    {
        return $query->where('status', '0')->where('action_user', $id);
    }
}
