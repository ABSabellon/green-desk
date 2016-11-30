<?php

namespace App\Http\Controllers;

use App\Room;
use App\Reservation;
use App\Reservee;
use Illuminate\Http\Request;
use Log;

class SearchController extends Controller
{
    //
    public function getRooms(Request $request) {
		$term = $request['term'];

    	$rooms = Room::where('room_no', 'LIKE', '%'.$term.'%')->get();

        return response()->json(['rooms' => $rooms], 200);
    }

    public function getReservations(Request $request) {
		$term = $request['term'];
        $filter = $request['filter'];

        if($filter == 'prof') {
            return $this->getReservationsByProf($term);
        } else if($filter == 'time') {
            return $this->getReservationsByTime($term);
        } else if($filter == 'room') {
            return $this->getReservationsByRoom($term);
        }
    }

    public function getReservationsByProf($term) {
        $reservees = Reservee::where('first_name', 'LIKE', '%'.$term.'%')
                                ->orWhere('last_name', 'LIKE', '%'.$term.'%')
                                ->orWhere('middle_name', 'LIKE', '%'.$term.'%')->get();
        foreach ($reservees as $reservee) {
            $reservation = Reservation::where('reservee_id', $reservee->id)->first();
            $reservations[] = $reservation;
            $names[] = $reservee->first_name . ' ' . $reservee->last_name;
            if($reservation->room_id == null) {
                $rooms[] = "";
            } else {
                $room = Room::find($reservation->room_id);
                $rooms[] = $room->room_no;
            }
        }

        return response()->json(['reservations' => $reservations, 'reservees' => $reservees, 'rooms' => $rooms], 200);
    }

    public function getReservationsByTime($term) {

    }

    public function getReservationsByRoom($term) {
        $rooms = Room::where('room_no', 'LIKE', '%'.$term.'%')->get();

        $reservations = array();
        $reservees = array();
        $roomNames = array();

        foreach ($rooms as $room) {
            $reservation = Reservation::where('room_id', $room->id)->first();
            if($reservation != null) {
                $reservations[] = $reservation;
                $reservee = Reservee::find($reservation->reservee_id);
                $reservees[] = $reservee;
                $names[] = $reservee->first_name . ' ' . $reservee->last_name;
                // if($reservation->room_id == null) {
                //     $rooms[] = "";
                // } else {
                //     $room = Room::find($reservation->room_id);
                //     $rooms[] = $room->room_no;
                // }
                $roomNames[] = $room->room_no;
            }
        }

        return response()->json(['reservations' => $reservations, 'reservees' => $reservees, 'rooms' => $roomNames], 200);
    }
}
