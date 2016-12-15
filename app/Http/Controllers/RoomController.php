<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{

    public function getRooms(Request $request) {
    	$rooms = Room::all();

    	return response()->json(['rooms' => $rooms], 200);
    }

    public function postAddRoom(Request $request) {
    	$room = new Room();
    	$room->room_no	 = $request['roomName'];
    	$room->room_type = $request['roomType'];
    	$room->floor = $request['floor'];
    	
        $room->available = 1;

        $room->save();

    }

    public function postSetActiveRoom(Request $request) {
        $id = $request['id'];

        $room = Room::find($id);

        if($request['set'] == 'true') {
            $room->available = 1;
        } else {
            $room->available = 0;
        }

        $room->save();
    }

    public function postDeleteRoom(Request $request) {
        $id = $request['id'];
        $room = Room::find($id);    
        $room->forceDelete();
    }

    public function postEditRoom(Request $request) {
        $room = Room::find($request['id']);

       	$room->room_no	 = $request['roomName'];
    	$room->room_type = $request['roomType'];
    	$room->floor = $request['floor'];

        $room->save();
    }
}
