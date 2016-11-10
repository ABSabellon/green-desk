<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservee extends Model
{
    //
    public function reservations() {
    	return $this->hasMany('App/Reservation');
    }
}
