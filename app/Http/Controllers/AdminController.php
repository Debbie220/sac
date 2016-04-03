<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Presentation;
use App\Course;
use App\User;
use App\Room;
use App\Timeslot;
use App\Conference;

class AdminController extends Controller
{
    public function __construct(){
      $this->middleware('admin');
    }

    public function make_conference(){
      $days =[1,2,3,4,5];
      $start = "00:00";
      $end = "23:30";
      $times=[];
      $tStart = strtotime($start);
      $tEnd = strtotime($end);
      $tNow = $tStart;
      $i=0;

      while($tNow <= $tEnd){
        //echo date("H:i",$tNow)."\n";
        $tNow = strtotime('+30 minutes',$tNow);
        $times[$i] = date("H:i", $tNow)."\n";
        $i = $i + 1;
      }
      return view('user.admin.new_conference', compact('days', 'times'));
    }

    public function create_conference(Request $request){
      $conference=new conference;
      $conference->description=$request['name'];
      $conference->save();
      $rooms = Room::where('available', true)->get();
      //make time a table and seed it
      $start = $request['start_time'];
      $end = $request['end_time'];
      $times=[];
      $tStart = strtotime($start);
      $tEnd = strtotime($end);
      $tNow = $tStart;
      $i=0;

      while($tNow <= $tEnd){
        //echo date("H:i",$tNow)."\n";
        $tNow = strtotime('+30 minutes',$tNow);
        $times[$i] = date("H:i", $tNow)."\n";
        $i = $i + 1;
      }
      //$i os the number of timeslots
      for($day=1; $day<=$request['days']; $day++){
        foreach($rooms as $room){
          foreach($times as $time){
            $timeslot= new Timeslot;
            $timeslot->day = $day;
            $timeslot->room_code = $room->code;
            $timeslot->conference_id = $conference->id;
            $timeslot->time = $time;
            $timeslot->save();
          }
        }
      }
      return Timeslot::all();
    }

}
