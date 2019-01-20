<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $table = 'abj_apartments.houses';

    public function realtors(){
        return $this->hasMany('App\Realtor_house', 'house_id');
    }

    public function is_shared($id)
    {
        $return = False;
        if($this->realtors->count() > 1) {
            foreach($this->realtors as $realtor_house) {
                if($realtor_house->realtor_id == $id && $realtor_house->shared==1) { //Then its a shared house
                    $return = True;
                    break;
                }
            }
        }
        return $return;
    }

    public function house_photos()
    {
        return $this->hasMany('App\House_photo');
    }

    public function house_comments()
    {
        return $this->hasMany('App\House_comment');
    }

    public function house_likes()
    {
        return $this->hasMany('App\House_like');
    }

    public function liked($id)
    {
        $return = False;
        foreach($this->house_likes as $like) {
            if($like->realtor_id==$id) {
                $return = True;
                break;
            }
        }
        return $return;
    }

    public function house_type()
    {
        return $this->belongsTo('App\House_type');
    }

    public function Price_range()
    {
        return $this->belongsTo('App\Price_range');
    }

    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    public function realtor()
    {
        return $this->belongsTo('App\Realtor');
    }

    public function estate()
    {
        return $this->belongsTo('App\Estate');
    }

    public static function boot ()
    {
        parent::boot();

        self::deleting(function (House $house) {

            foreach ($house->realtors as $realtor)
            {
                $realtor->delete();
            }

            foreach ($house->house_photos as $photo)
            {
                $photo->delete();
            }

            foreach ($house->house_likes as $like)
            {
                $like->delete();
            }

            foreach ($house->house_comments as $comment)
            {
                $comment->delete();
            }
        });
    }
}
