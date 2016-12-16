<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taker extends Model
{
    //
    public function exam() {
    	return $this->hasMany('App\Exam');
    }
}
