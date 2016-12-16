<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;

class SectionController extends Controller
{
    //
    public function getSections(Request $request) {
    	$sections = Section::all();

    	return response()->json(['sections' => $sections], 200);
    }
}
