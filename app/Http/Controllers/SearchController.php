<?php

namespace App\Http\Controllers;

use App\Room;
use App\Reservation;
use App\Reservee;
use App\Exam;
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
        $type = $request['type'];
        $filter = $request['filter'];
        $type = $request['type'];

        if($filter == 'prof') {
            return $this->getReservationsByProf($term, $type);
        } else if($filter == 'room') {
            return $this->getReservationsByRoom($term, $type);
        } else if($filter == 'subject') {
            return $this->getReservationsBySubject($term);
        } else if($filter == 'section') {
            return $this->getReservationsBySection($term);
        }
    }

    public function getReservationsByProf($term, $type) {
        $reservees = Reservee::where('first_name', 'LIKE', '%'.$term.'%')
                                ->orWhere('last_name', 'LIKE', '%'.$term.'%')
                                ->orWhere('middle_name', 'LIKE', '%'.$term.'%')->get();
        $reservations = array();
        $rooms = array();
        foreach ($reservees as $reservee) {
            if($type == 'GC') {
                $reservation = Reservation::whereNull('exam_id')
                                        ->where('reservee_id', $reservee->id)->first();
            } else if($type == 'Exam') {
                $reservation = Reservation::whereNotNull('exam_id')
                                        ->whereNotNull('room_id')
                                        ->where('reservee_id', $reservee->id)->first();
            }
            Log::info($reservation);
            $reservation->reservee = $reservee;
            if($reservation->room_id == null) {
                $reservation->room_no = "";
            } else {
                $room = Room::find($reservation->room_id);
                $reservation->room_no = $room->room_no;
            }
            $reservations[] = $reservation;
        }

        return response()->json(['reservations' => $reservations], 200);
    }

    public function getReservationsByRoom($term, $type) {
        $rooms = Room::where('room_no', 'LIKE', '%'.$term.'%')->get();

        $reservations = array();

        foreach ($rooms as $room) {
            if($type == 'GC') {
                $reservation = Reservation::whereNull('exam_id')
                                        ->where('room_id', $room->id)->first();
            } else if($type == 'Exam') {
                $reservation = Reservation::whereNotNull('exam_id')
                                        ->where('room_id', $room->id)->first();
            }
            if($reservation != null) {
                $reservation->room_no = $room->room_no;
                $reservee = Reservee::find($reservation->reservee_id);
                $reservation->reservee = $reservee;
                $reservation->exam = Exam::find($reservation->exam_id);
                $reservations[] = $reservation;
            }
        }

        return response()->json(['reservations' => $reservations], 200);
    }

    public function getReservationsBySubject($term) {
        $exams = Exam::where('subject', 'LIKE', '%'.$term.'%')->get();

        $reservations = array();

        foreach ($exams as $exam) {
            $reservation = Reservation::where('exam_id', $exam->id)->first();
            $reservation->exam = $exam;
            $reservation->reservee = Reservee::find($reservation->reservee_id);
            $room = Room::find($reservation->room_id);
            $reservation->room_no = $room->room_no;
            $reservations[] = $reservation;
        }

        return response()->json(['reservations' => $reservations], 200);
    }

    public function getReservationsBySection($term) {
        $exams = Exam::where('section', 'LIKE', '%'.$term.'%')->get();

        $reservations = array();

        foreach ($exams as $exam) {
            $reservation = Reservation::where('exam_id', $exam->id)->first();
            $reservation->exam = $exam;
            $reservation->reservee = Reservee::find($reservation->reservee_id);
            $room = Room::find($reservation->room_id);
            $reservation->room_no = $room->room_no;
            $reservations[] = $reservation;
        }

        return response()->json(['reservations' => $reservations], 200);
    }
}
