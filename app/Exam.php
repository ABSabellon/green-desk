<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    //
    public function reservations() {
    	return $this->hasMany('App/Reservation');
    }
}
