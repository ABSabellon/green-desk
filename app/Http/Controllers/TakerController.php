<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Taker;

class TakerController extends Controller
{
    //
    public function getTakers(Request $request) {
    	$takers = Taker::all();

    	return response()->json(['takers' => $takers], 200);
    }
}
