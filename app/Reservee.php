<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservee extends Model
{
    //
    public function reservations() {
    	return $this->hasMany('App/Reservation');
    }

    public static function getReserveeWithName($last, $first, $middle){
        return \DB::table('reservees')
            ->where('first_name', '=', $first)
            ->where('last_name', '=', $last);;
    }
}
