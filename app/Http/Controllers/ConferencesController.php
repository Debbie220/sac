<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Conference;
use App\Presentation;

class ConferencesController extends Controller
{
    function old(Request $request) {
    	$id = $request['id'];
    	if($id == null)
    		$id = get_current_conference_id();
    	$conferences = Conference::where('id', '<>', get_current_conference_id())->
    		orderBy('id', 'desc')->get();
   		$chosen_conf = Conference::where('id', '=', $id)->first();
    	$presentations = Presentation::where('conference_id', '=', $id)->
    		where('status', '=', 'A')->
    		orderBy('course_id')->
    		get();
    	return view('conferences.old',
    		compact('conferences', 'chosen_conf', 'presentations'));
    }
}
