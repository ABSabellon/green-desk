<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\Reservee;
use App\Room;
use App\Exam;
use App\Subject;
use App\Section;
use App\Taker;
use Log;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    //
    public function postAddReservation(Request $request) {
        $exam = new Exam();

        $exam->subject_id = $request['subject'];
        $exam->section_id = $request['section'];
        $exam->taker_id = $request['taker'];

        $exam->save();

        $reservation = new Reservation();

        $reservation->reservee_id = $request['prof'];
        $reservation->exam_id = $exam->id;

        $reservation->save();
    }

    public function getReservations(Request $request) {
        if($request['filter'] == null) {
            $reservations = Reservation::whereNotNull('exam_id')->get();  
        } else if($request['filter'] == 'notnull') {
            $reservations = Reservation::whereNotNull('exam_id')->whereNotNull('room_id')->get();
        } else {
            $reservations = Reservation::whereNotNull('exam_id')->where('date', $request['filter'])->get();
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
            $exam = Exam::find($reservation->exam_id);
            $exam->subject = Subject::find($exam->subject_id)->subject;
            $exam->section = Section::find($exam->section_id)->section;
            $exam->takers = Taker::find($exam->taker_id)->taker;
            $reservation->exam = $exam;
        }
        return response()->json(['reservations' => $reservations], 200);
    }

    public function postEditReservation(Request $request) {
        $reservation = Reservation::find($request['index']);
        $room = Room::where('room_no', $request['room'])->first();
        $reservations = Reservation::whereNotNull('exam_id')->get();

        foreach ($reservations as $res) {
            if($reservation->id != $res->id) {
                $start_ts = $res->time_start;
                $end_ts = $res->time_end;

                $roomRes = Room::find($res->room_id);
                $roomNo = ($roomRes != null)? $roomRes->room_no:null;

                $date = $res->date;

                Log::info($date);
                Log::info($request['date']);

                if($roomNo == $request['room'] && 
                    $date == $request['date'] && 
                    $this->checkConflict($start_ts, $end_ts, $request['startTime']) != null) {
                        $prof = Reservee::find($res->reservee_id);
                        $profName = $prof->first_name . ' ' . $prof->last_name;
                        return response()->json(['warning' => 'Conflict with ' . $profName . '!'], 200);
                }

                if($roomNo == $request['room'] && 
                    $date == $request['date'] && 
                    $this->checkConflict($start_ts, $end_ts, $request['endTime']) != null) {
                        $prof = Reservee::find($res->reservee_id);
                        $profName = $prof->first_name . ' ' . $prof->last_name;
                        return response()->json(['warning' => 'Conflict with ' . $profName . '!'], 200);
                }
            }

        }

        $reservation->date = $request['date'];
        $reservation->time_start = $request['startTime'];
        $reservation->time_end = $request['endTime'];
        $reservation->room_id = $room->id;

        $reservation->save();

    }

    private function checkConflict($start_range, $end_range, $user_time) {
        return (($user_time >= $start_range) && ($user_time <= $end_range));
    }

    public function export(){
        $data = Reservation::whereNotNull('exam_id')->get()->toArray();
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
