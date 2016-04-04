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
      $numDays=1;
      $first = "00:00";
      $last = "23:30";
      $times=[];
      $tStart = strtotime($first);
      $tEnd = strtotime($last);
      $tNow = $tStart;
      $i=0;

      while($tNow <= $tEnd){
        //echo date("H:i",$tNow)."\n";
        $tNow = strtotime('+30 minutes',$tNow);
        $times[$i] = date("H:i", $tNow)."\n";
        $i = $i + 1;
      }

      return view('user.admin.new_conference', compact('days', 'times', 'numDays'));
    }

    public function create_conference(Request $request){
        //return $request['start_time'];
        $conference=new conference;
        $conference->description=$request['name'];
        $conference->save();
        $rooms = Room::where('available', true)->get();


        $first = $request['start_time'];
        $last = $request['end_time'];
        $numDays = sizeOf($first);
        //start day loop from here
        if($numDays =1 ){
          $times=[];
          $tStart = strtotime($first[0]);
          $tEnd = strtotime($last[0]);
          $tNow = $tStart;
          $i=1;

          $times[0] = date("H:i", $tNow)."\n";
          while($tNow < $tEnd){
            $tNow = strtotime('+30 minutes',$tNow);
            $times[$i] = date("H:i", $tNow)."\n";
            $i = $i + 1;
          }
          foreach($rooms as $room){
            foreach($times as $time){
              $timeslot= new Timeslot;
              $timeslot->day = 1;
              $timeslot->room_code = $room->code;
              $timeslot->conference_id = $conference->id;
              $timeslot->time = $time;
              $timeslot->save();
            }
          }
        }
        else{
        for($day=1, $index=0; $day<$numDays || $index<($numDays - 1); $day++, $index++){
        $times=[];
        $tStart = strtotime($first[$index]);
        $tEnd = strtotime($last[$index]);
        $tNow = $tStart;
        $i=1;

        $times[0] = date("H:i", $tNow)."\n";
        while($tNow < $tEnd){
          $tNow = strtotime('+30 minutes',$tNow);
          $times[$i] = date("H:i", $tNow)."\n";
          $i = $i + 1;
        }
        //$i os the number of timeslots
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
      }
        flash()->success("New conference created successfully!!");
        return redirect()->route('user.show', Auth::user()->id);
        //return Timeslot::where('conference_id', $conference->id)->get();

    }

}
