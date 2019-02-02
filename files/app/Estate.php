<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estate extends Model
{
    // protected $table = 'abj_apartments.estates';

	public function houses()
    {
        return $this->hasMany('App\House')->where('available', '1');
    }

    public function estate_photos()
    {
        return $this->hasMany('App\Estate_photo');
    }

    public function Unavailablehouses()
    {
        return $this->houses()->where('available', '0');
    }

    public function realtor()
    {
        return $this->belongsTo('App\Realtor');
    }

    public function location()
    {
        return $this->belongsTo('App\Location');
    }


    public static function boot ()
    {
        parent::boot();

        self::deleting(function (Estate $estate) {

            foreach ($estate->houses as $house)
            {
                $house->delete();
            }

            foreach ($estate->estate_photos as $photo)
            {
                $photo->delete();
            }
        });
    }
}
