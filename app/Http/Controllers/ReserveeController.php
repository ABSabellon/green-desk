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

    	$reservee->save();

    	$reservation = new Reservation();

    	$reservation->reservee_id = $reservee->id;

    	$reservation->save();
    }

    public function getProfessors(Request $request) {
    	$reservees = Reservee::all();
    	

        return response()->json(['reservees' => $reservees], 200);
    }

    public function import(Request $request){
        $file = $request->file('importfile')->move(public_path(), 'import.csv');
        //read file here
        //Should empty table?
        //loop til last line
            //$reservee = new Reservee;
            //$reservee->name = <values>
            //$reservee->save();
        //end loop
    }
}
