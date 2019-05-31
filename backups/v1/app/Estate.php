<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estate extends Model
{
	public function houses()
    {
        return $this->hasMany('App\House')->where('available', '1');
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
        });
    }
}
