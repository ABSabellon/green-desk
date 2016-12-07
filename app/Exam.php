<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    //
    public function reservations() {
    	return $this->hasMany('App\Reservation');
    }

    public function subject() {
        return $this->hasOne('App\Subject');
    }

    public function section() {
        return $this->hasOne('App\Section');
    }

    public function takers() {
        return $this->hasOne('App\Taker');
    }
    
}
