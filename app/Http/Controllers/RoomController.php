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

    public function getRoomsByFloor(Request $request) {
    	$rooms = Room::where('floor', $request['floor'])->get();

    	return response()->json(['rooms' => $rooms], 200);
    }
}
