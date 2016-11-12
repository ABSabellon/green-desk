<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\Reservee;
use App\Room;
use Log;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    //
    public function postAddReservation(Request $request) {
    	$reservation = new Reservation();
        $reservee = new Reservee();

        $reservee->first_name = $request['firstName'];
        $reservee->middle_name = "Middle";
        $reservee->last_name = $request['lastName'];
        $reservee->reservee_type = $request['patron'];
        $reservee->save();

        $room = Room::where('room_no', $request['room'])->first();
    	$reservation->room_id = $room->id;
        $reservation->reservee_id = $reservee->id;

    	$reservation->name = $request['eventName'];
    	$reservation->description = $request['description'];
    	$reservation->status = 'ONGOING'; //default status
    	$reservation->archived = 0;

    	//dates and times
    	$timeStart = date_create_from_format('H-i-s', $request['startTime']);;
    	$reservation->time_start = $timeStart;
    	$timeEnd = date_create_from_format('H-i-s', $request['endTime']);
        $reservation->time_end = $timeEnd;
        $date = date_create_from_format('Y-m-d', $request['date']);
        $reservation->date = $date;

    	$reservation->save();

    }

    public function getReservationByDate(Request $request) {
    	$date = $request['date'];

    	$reservations = Reservation::where('date', $date)->get();

    	return response()->json(['reservations' => $reservations], 200);
    }

    public function getReservationByReservee(Request $request) {
    	$reservee_id = $request['reservee_id'];
    	$reservee = Reservee::where('id', $reservee_id)->first;

    	$reservations = Reservation::where('reservee_id', $reservee->id)->get();

    	return response()->json(['reservations' => $reservations], 200);
    }

    public function getReservationByType(Request $request) {
    	$type = $request['type'];

    	$reservations = Reservation::where('');
    }


}