<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\Reservee;
use App\Room;
use App\Exam;
use Log;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    //
    public function postAddReservation(Request $request) {
    	$reservation = Reservation::find($request['index']);
        $room = Room::where('room_no', $request['room']);

        $reservation->time_start = $request['startTime'];
        $reservation->time_end = $request['endTime'];
        $reservation->room_id = $room->id;

        $reservation->save();

     //    $reservee = Reservee::where('first_name', $request['firstName'])
     //                        ->where('last_name', $request['lastName'])->first();

     //    if($reservee == null) {
     //        $reservee = new Reservee();
     //        $reservee->first_name = $request['firstName'];
     //        $reservee->middle_name = "Middle";
     //        $reservee->last_name = $request['lastName'];
     //        $reservee->reservee_type = $request['patron'];
     //        $reservee->save();
     //    }

     //    $room = Room::where('room_no', $request['room'])->first();
    	// $reservation->room_id = $room->id;
     //    $reservation->reservee_id = $reservee->id;

    	// $reservation->name = $request['eventName'];
    	// $reservation->description = $request['description'];
    	// $reservation->status = 'ONGOING'; //default status
    	// $reservation->archived = 0;

     //    $date = date_create($request['date']);
     //    $reservation->date = $date;

     //    $times = explode(':', $request['startTime']);
     //    date_time_set($date, $times[0], $times[1]);
     //    $reservation->time_start = $date;

     //    $temp = clone $date;

     //    $times = explode(':', $request['endTime']);
     //    date_time_set($temp, $times[0], $times[1]);
     //    $reservation->time_end = $temp;

     //    if($request['isExam'] == 'true') {
     //        $exam = new Exam();
     //        $exam->subject = $request['subject'];
     //        $exam->section = $request['section'];
     //        $exam->save();
     //        $reservation->exam_id = $exam->id;
     //    }

    	// $reservation->save();

    }

    public function getReservations(Request $request) {
        if($request['filter'] == null) {
            $reservations = Reservation::all();  
        } else {
            $reservations = Reservation::where('date', $request['filter'])->get();
        }

        $reservees = array();
        foreach ($reservations as $reservation) {
            $reservee = Reservee::find($reservation->reservee_id);
            $reservees[] = $reservee;
            if($reservation->room_id == null) {
                $rooms[] = "";
            } else {
                $room = Room::find($reservation->room_id);
                $rooms[] = $room->room_no;
            }
        }

        return response()->json(['reservations' => $reservations, 'reservees' => $reservees, 'rooms' => $rooms], 200);
    }

    public function postEditReservation(Request $request) {
        $reservation = Reservation::find($request['index']);
        $room = Room::where('room_no', $request['room'])->first();

        $reservation->time_start = $request['startTime'];
        $reservation->time_end = $request['endTime'];
        $reservation->room_id = $room->id;

        $reservation->save();

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

    public function export(){
        $data = Reservation::all()->toArray();
        $path = public_path() . '/export.csv';
        $out = fopen($path, 'w');
        fputcsv($out, array_keys($data[1]));
        foreach($data as $line)
        {
            fputcsv($out, $line);
        }
        fclose($out);

        return response()->download($path);
    }
}
