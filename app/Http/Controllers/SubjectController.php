<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;

class SubjectController extends Controller
{
    //
    public function getSubjects(Request $request) {
    	$subjects = Subject::all();

    	return response()->json(['subjects' => $subjects], 200);
    }
}
