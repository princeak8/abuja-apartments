<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Circle_record extends Model
{
    /*
        Status Assignments
        0  = Friend Request Sent(Pending)
        1  = Friend Request Accepted
        -1 = Friend Request Rejected
    */
    public function userOne()
    {
    	return $this->belongsTo('App\Realtor', 'user_one', 'id');
    }

    public function userTwo()
    {
        return $this->belongsTo('App\Realtor', 'user_two', 'id');
    }

    public function scopeGetCircleRecords($query, $id)
    {
        return $query->where('user_one', $id)->orWhere('user_two', $id);
    }

    public function scopeCircleRequests($query, $id)
    {
        return $query->where('user_one', $id)->orWhere('user_two', $id)->where('status', '0');
    }

    public function scopeSentRequests($query, $id)
    {
        return $query->where('status', '0')->where('active_user', $id);
    }
}
