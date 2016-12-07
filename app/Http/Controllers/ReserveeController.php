<?php

namespace App\Http\Controllers;

use App\Reservee;
use App\Reservation;
use Illuminate\Http\Request;

class ReserveeController extends Controller
{
    //
    public function postAddProfessor(Request $request) {
    	$reservee = new Reservee();

    	$reservee->first_name = $request['firstName'];
    	$reservee->last_name = $request['lastName'];
    	$reservee->middle_name = '';
    	$reservee->reservee_type = 'Professor';
    	$reservee->professor_status = $request['profType'];
    	$reservee->professor_college = $request['college'];
    	$reservee->professor_base = $request['profBase'];
        $reservee->is_active = 1;

    	$reservee->save();

    	$reservation = new Reservation();

    	$reservation->reservee_id = $reservee->id;

    	$reservation->save();
    }

    public function getProfessors(Request $request) {
    	$reservees = Reservee::all();
    	
        // foreach ($reservees as $reservee) {
        //     if(Reservation::where('reservee_id', $reservee->id)->first() == null) {
        //         $reservation = new Reservation();
        //         $reservation->reservee_id = $reservee->id;
        //         $reservation->save();
        //     }
        // }

        return response()->json(['reservees' => $reservees], 200);
    }

    public function postSetActive(Request $request) {
        $id = $request['id'];

        $prof = Reservee::find($id);

        if($request['set'] == 'true') {
            $prof->is_active = 1;
        } else {
            $prof->is_active = 0;
        }

        $prof->save();
    }

    public function postEditProfessor(Request $request) {
        $reservee = Reservee::find($request['id']);

        $reservee->first_name = $request['firstname'];
        $reservee->middle_name = $request['middlename'];
        $reservee->last_name = $request['lastname'];

        $reservee->save();
    }

    public function import(Request $request){
        $file = $request->file('importfile')->move(public_path(), 'import.csv');
        $contents = $file = fopen(public_path(). '\import.csv', 'r');
        $header = null;
        while (($line = fgetcsv($contents)) !== FALSE) {
            if($header == null) {
                $header = $line;
            }
            else{
                /*0 => "﻿Last Name"
                1 => "First Name"
                2 => "Middle Name "
                3 => "Type"
                4 => "College"
                5 => "Base"*/
                $reservee = new Reservee;
                $reservee->first_name = $line[1];
                $reservee->last_name = $line[0];
                $reservee->middle_name = $line[2];
                $reservee->professor_status = $line[3];
                $reservee->professor_college = $line[4];
                $reservee->professor_base = $line[5];
                $reservee->reservee_type = 'Professor';
                $reservee->save();
            }
        }
        return redirect('/professorlist');
    }
}
