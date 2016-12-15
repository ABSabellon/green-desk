<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $hidden = ["created_at", "updated_at"];

    //
    public function room() {
    	return $this->belongsTo('App/Room');
    }

    public function event() {
    	return $this->hasOne('App/Event');
    }

    public function reservee() {
    	return $this->hasOne('App/Reservee');
    }

    public function exam() {
        return $this->hasOne('App/Exam');
    }

    public static function getReservationsTable(){
        //"SELECT reservees.last_name, reservees.first_name, reservees.middle_name, reservations.time_start, rooms.room_no FROM reservations, reservees, rooms WHERE reservations.reservee_id = reservees.id AND reservations.room_id = rooms.id"
        //this query ^ in eloquent representation
        $data = \DB::table('reservations')
                //->select('reservees.last_name as Last_Name', 'reservees.first_name as First_Name', 'reservees.middle_name as Middle_Name', 'reservations.time_start as Time_Start', 'rooms.room_no as Room')
                ->select('reservees.professor_college', \DB::raw('CONCAT(reservees.first_name, " ", reservees.middle_name, " ", reservees.last_name) as Name'), 'reservations.time_start as Time_Start', 'rooms.room_no as Room')
                ->join('reservees', 'reservations.reservee_id', '=', 'reservees.id')
                ->join('rooms', 'reservations.room_id', '=', 'rooms.id');
        $data->headers = ['Row Number', 'College of Prof', 'Prof Name', 'Time Start', 'Room'];
        //row number, college of prof, prof name(Last, First, Middle), time, room
        return $data;
    }
}
