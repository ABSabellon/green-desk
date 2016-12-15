<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\Reservee;
use App\Room;
use App\Exam;
use Log;
use Illuminate\Http\Request;

class GCController extends Controller
{
    //
    public function postAddReservation(Request $request) {
    	$reservation = Reservation::find($request['index']);
        $room = Room::where('room_no', $request['room']);

        $reservation->time_start = $request['startTime'];
        $reservation->time_end = $request['endTime'];
        $reservation->room_id = $room->id;

        $reservation->save();
    }

    public function getReservations(Request $request) {
        if($request['filter'] == null) {
            $reservations = Reservation::whereNull('exam_id')->get();  
        } else if($request['filter'] == 'notnull') {
            $reservations = Reservation::whereNull('exam_id')->whereNotNull('room_id')->get();
        } else {
            $reservations = Reservation::whereNull('exam_id')->where('date', $request['filter'])->get();
        }

        foreach ($reservations as $reservation) {
            $reservee = Reservee::find($reservation->reservee_id);
            $reservation->reservee = $reservee;
            if($reservation->room_id == null) {
                $reservation->room_no = "";
            } else {
                $room = Room::find($reservation->room_id);
                $reservation->room_no = $room->room_no;
            }
        }
        return response()->json(['reservations' => $reservations], 200);
    }

    public function postEditReservation(Request $request) {
        $reservation = Reservation::find($request['index']);
        $room = Room::where('room_no', $request['room'])->first();
        $reservations = Reservation::whereNull('exam_id')->get();

        foreach ($reservations as $res) {
            if($reservation->id != $res->id) {
                $start_ts = $res->time_start;
                $end_ts = $res->time_end;

                $roomRes = Room::find($res->room_id);
                $roomNo = ($roomRes != null)? $roomRes->room_no:null;

                if($this->checkConflict($start_ts, $end_ts, $request['startTime'], $roomNo, $request['room']) != null) {
                    $prof = Reservee::find($res->reservee_id);
                    $profName = $prof->first_name . ' ' . $prof->last_name;
                    return response()->json(['warning' => 'Conflict with ' . $profName . '!'], 200);
                }

                if($this->checkConflict($start_ts, $end_ts, $request['endTime'], $roomNo, $request['room']) != null) {
                    $prof = Reservee::find($res->reservee_id);
                    $profName = $prof->first_name . ' ' . $prof->last_name;
                    return response()->json(['warning' => 'Conflict with ' . $profName . '!'], 200);
                }
            }

        }

        $reservation->time_start = $request['startTime'];
        $reservation->time_end = $request['endTime'];
        $reservation->room_id = $room->id;

        $reservation->save();

    }

    private function checkConflict($start_range, $end_range, $user_time, $roomNo, $userRoomNo) {
        if($roomNo == $userRoomNo)
            return (($user_time >= $start_range) && ($user_time <= $end_range));
        else
            return 0;
    }

    public function export(){
        $data = Reservation::getReservationsTable();
        $path = public_path() . '/export.csv';
        $out = fopen($path, 'w');
        fputcsv($out, $data->headers);
        $counter = 1;
        foreach($data->get()->toArray() as $line)
        {
            $x = (array) $line;
            array_unshift($x, $counter);
            fputcsv($out, $x);
            $counter++;
        }
        fclose($out);

        return response()->download($path);
    }

    public function import(Request $request){
        $file = $request->file('importfile')->move(public_path(), 'import.csv');
        $contents = $file = fopen(public_path(). '\import.csv', 'r');
        $header = null;
        $err = null;
        while (($line = fgetcsv($contents)) !== FALSE) {
            if($header == null) {
                $header = $line;
            }
            else{
                /*
                0 - College
                1 - Last Name
                2 - First Name 
                3 - Middle Name
                4 - Time Start
                5 - Time End
                5 - Room
                */
                $data = new Reservation;
                $data->time_start = $line[4];
                $data->time_end = $line[5];

                $reservee = Reservee::getReserveeWithName($line[1], $line[2], $line[3])->get();
                /*dd(count(Reservee::getReserveeWithName('a','b','c')->get()));*/
                if(count($reservee) > 0){
                    $data->reservee_id = $reservee[0]->id;
                }
                else {
                    $err = "Prof with id:" . $data->reservee_id . " does not exist";
                }
                
                $room = Room::getRoomId($line[6])->get();
                
                if(count($room) > 0){
                    $data->room_id = $room[0]->id;
                }
                else {
                    $err = "Prof with id:" . $data->reservee_id . " does not exist";
                }               
                
                if($err == null){
                    $data->save();
                }
            }
        }

        if($err){
            return redirect('/gradeconsultation');
        }
        else{
            return $err;
        }
    }
}
