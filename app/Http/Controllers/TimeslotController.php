<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Timeslot;
use App\Conference;
use JavaScript;
use App\Presentation;


class TimeslotController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function show_schedule($display_room = null){
      $presentations = Presentation::where('status', 'A')->
        where('conference_id', '=', get_current_conference_id())->get();
      $conference = Conference::orderBy('id','desc')->first();
      $timeslots = Timeslot::where('conference_id', $conference->id)->
                      where('room_code', $display_room)->
                      orderBy('time')->get();
      $rooms = Timeslot::where('conference_id',$conference->id)->
          select('room_code')->distinct()->get();
      $days = Timeslot::where('conference_id', $conference->id)->
          select('day')->distinct()->get();

      JavaScript::put([
        'timeslots' => $timeslots
      ]);

      //Possible hours for creating a new timeslot
      $start = "00:00";
      $end = "23:00";
      $hours=[];
      $tStart = strtotime($start);
      $tEnd = strtotime($end);
      $tNow = $tStart;
      $i=0;
      while($tNow <= $tEnd){
        //echo date("H:i",$tNow)."\n";
        $hours[$i] = date("H:i", $tNow)."\n";
        $tNow = strtotime('+60 minutes',$tNow);
        $i = $i + 1;
      }
      //Possible minutes for creating a new timeslot
      $start = "00:00";
      $end = "00:59";
      $minutes=[];
      $tStart = strtotime($start);
      $tEnd = strtotime($end);
      $tNow = $tStart;
      $i=0;
      while($tNow <= $tEnd){
        //echo date("H:i",$tNow)."\n";
        $minutes[$i] = date("H:i", $tNow)."\n";
        $tNow = strtotime('+1 minutes',$tNow);
        $i = $i + 1;
      }

      return view('presentations.schedule', compact('presentations',
      'rooms','display_room', 'timeslots', 'days', 'hours', 'minutes'));
    }

    

    public function deleteTime($display_room, $id){
      Timeslot::destroy($id);
      return redirect()->route('timeslot.show', compact('display_room'));
    }

}
