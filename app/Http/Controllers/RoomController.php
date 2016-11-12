<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    //
    public function getRooms(Request $request) {
    	$rooms = Room::all();

    	return response()->json(['rooms' => $rooms], 200);
    }
}
