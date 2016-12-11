<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //
    public function reservations() {
    	return $this->hasMany('App/Reservation');
    }

    public function roomtype() {
    	return $this->hasOne('App/RoomType');
    }

    public static function getRoomId($room_no){
        return \DB::table('rooms')
            ->where('room_no', '=', $room_no);
    }
}
