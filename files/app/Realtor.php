<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Realtor extends Authenticatable
{
	public function scopeGetRealtors($query)
    {
        return $query->where('activated', '1');
    }

    public function scopeGetVisitors($query)
    {
        return $query->where('activated', '0');
    }

    public function scopeGetRealtor($query, $id)
    {
        return $query->where('id', $id)->first();
    }

    public function getFullNameAttribute()
    {
    	return $this->firstname.' '.$this->lastname;
    }

    public function estates(){
        return $this->hasMany('App\Estate', 'realtor_id');
    }

    //All the houses that I own and the ones shared with me
    public function Allhouses(){
        return $this->hasMany('App\Realtor_house', 'realtor_id');
    }

    //All the houses that I own and the ones shared with me that are available
    public function houses(){
        return $this->Allhouses()->where('available', '1');
    }

    //The houses that I own
    public function Myhouses(){
        return $this->houses()->where('shared', '0');
    }

    //unavailable houses that I own
    public function Unavailablehouses(){
        return $this->Allhouses()->where('available', '0');
    }

    //My houses that I shared with other realtors
    public function mySharedHouses(){
        return $this->myhouses()->where('shared_with', '>', '0');
    }

    //Instances of houses that I shared with other realtors
    public function sharedHouses(){
         return $this->hasMany('App\Realtor_house', 'sharer_id');
    }

    //Houses shared with me that I have approved
    public function shared_with_me()
    {
        return $this->houses()->where('shared', '1');
    }

    //Is house shared with this realtor
    public function is_shared_with_realtor($id)
    {
        $return = False;
        if($this->shared_by_me->count() > 0) {
            foreach($this->sharedHouses as $shared) {
                if($shared->realtor_id == $id) {
                    $return = True;
                    break;
                }
            }
        }
        return $return;
    }


    public function share_requests()
    {
        return $this->hasMany('App\Share_request', 'shared_id');
    }

    public function sent_share_requests()
    {
       return $this->hasMany('App\Share_request', 'sharer_id');
    }

    //To check if I own a particular house or its shared with me
    public function connected_house($id)
    {
    	$return = False;
    	foreach($this->Allhouses as $house) {
    		if($house->house_id==$id) {
    			$return = True;
    			break;
    		}
    	}
    	return $return;
    }

    public function followers(){
        return $this->hasMany('App\Follower', 'realtor_id');
    }

    public function following(){
        return $this->hasMany('App\Follower', 'follower_id');
    }

    public function phones(){
        return $this->hasMany('App\Realtor_phone', 'realtor_id');
    }

    public function is_follower($id)
    {
    	$return = False;
    	foreach($this->followers as $follower) {
    		if($follower->follower_id == $id){
    			$return = True;
    			break;
    		}
    	}
    	return $return;
    }

    public function house_likes()
    {
        return $this->hasMany('App\House_like');
    }

    public function house_comments()
    {
        return $this->hasMany('App\House_comment');
    }

    public function users_one()
    {
        return $this->hasMany('App\Circle', 'user_one');
    }

    public function users_two()
    {
        return $this->hasMany('App\Circle', 'user_two');
    }

    public function relations()
    {
        return $this->users_one->union($this->users_two->toBase());
    }

    public function circle()
    {
        return $this->users_one()->where('status', '1')->union($this->users_two()->where('status', '1')->toBase());
    }

    public function sent_requests()
    {
        return $this->users_one->where('status', '!=', '1')->where('action_user', $this->id)->union($this->users_two->where('status', '!=', '1')->where('action_user', $this->id)->toBase());
    }

    public function circle_requests()
    {
        return $this->users_one->where('status', '0')->where('action_user', '!=', $this->id)->union($this->users_two->where('status', '0')->where('action_user', '!=', $this->id)->toBase());
    }

    public function rship_exists($id)
    {
        $return = False;
        foreach($this->relations() as $rship) {
            if(($rship->user_one==$this->id && $rship->user_two==$id) || ($rship->user_two==$this->id && $rship->user_one==$id)) {
                $return = True;
                break;
            }
        }
        return $return;
    }

    public function in_circle($id)
    {
        $return = False;
        foreach($this->circle as $rship) {
            if(($rship->user_one==$this->id && $rship->user_two==$id) || ($rship->user_two==$this->id && $rship->user_one==$id)) {
                $return = True;
                break;
            }
        }
        return $return;
    }

    public function request_sent($id)
    {
        $return = False;
        foreach($this->sent_requests() as $rship) {
            if($rship->action_user==$this->id && $rship->status==0) {
                $return = True;
                break;
            }
        }
        return $return;
    }

    public function circle_request_awaiting_my_approval($id)
    {
        $return = False;
        foreach($this->sent_requests() as $rship) {
            if($rship->action_user!=$this->id && $rship->status==0) {
                $return = True;
                break;
            }
        }
        return $return;
    }

    public function sent_messages(){
        return $this->hasMany('App\Message', 'sender_id');
    }

    public function received_messages(){
        return $this->hasMany('App\Message', 'receiver_id');
    }

    public function unread_messages()
    {
        return $this->received_messages()->where('read', '0');
    }

    public static function boot ()
    {
        parent::boot();

        self::deleting(function (Realtor $realtor) {

            foreach ($realtor->myhouses as $myhouse)
            {
                $myhouse->delete();
            }
            foreach ($realtor->Allhouses as $house)
            {
                $house->delete();
            }
            foreach ($realtor->estates as $estate)
            {
                $estate->delete();
            }
            foreach ($realtor->followers as $follower)
            {
                $follower->delete();
            }
            foreach ($realtor->following as $follow)
            {
                $follow->delete();
            }
            foreach ($realtor->phones as $phone)
            {
                $phone->delete();
            }
            foreach ($realtor->house_likes as $like)
            {
                $like->delete();
            }
            foreach ($realtor->house_comments as $comment)
            {
                $comment->delete();
            }
        });
    }

}
