<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //
    public function exam() {
    	return $this->hasMany('App\Exam');
    }
}
