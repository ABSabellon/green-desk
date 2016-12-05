<?php

namespace App\Http\Controllers;

use App\Reservee;
use App\Reservation;
use Illuminate\Http\Request;
use File;

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

    public function import(Request $request){
        $file = $request->file('importfile')->move(public_path(), 'import.csv');
       $content = File::get(public_path(). '\import.csv'); //read file here
        //Should empty table?
        $fin = array();
        foreach($content as $line) {    //loop til last line
            //use $line 
            $line_data = str_getcsv($line);
            array_push($fin, $line_data);
            //$reservee = new Reservee;
            //$reservee->name = <values>
            //$reservee->save();
        }
        dd($fin);
        //end loop
    }
}
