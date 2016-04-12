<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Conference;

class ConferencesController extends Controller
{
    function old(){
    	$conferences = Conference::where('id', '<>', get_current_conference_id())->
    		orderBy('id', 'desc')->get();
    	return view('conferences.old', compact('conferences'));
    }
}
