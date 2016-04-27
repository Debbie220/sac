<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Timeslot;
use App\Conference;
use JavaScript;
use App\Presentation;
use App\Room;
use DB;

class TimeslotController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function show_schedule($display_room = null){
      $presentations = Presentation::where('status', 'A')->
        where('conference_id', '=', get_current_conference_id())->get();
      $unscheduled = Presentation::where('status', 'A')->
        where('conference_id', '=', get_current_conference_id())->
        where('timeslot', NULL)->get();
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

      return view('timeslots.schedule', compact('presentations', 'unscheduled',
      'rooms','display_room', 'timeslots', 'days', 'hours', 'minutes'));
    }

    public function update_schedule($display_room = null){
      if (Input::has('timeslots')){
        $formvalues = Input::all();
        $timeslots = $formvalues['timeslots'];
        //Here we assign presentations to timeslots
        foreach ($timeslots as $timeslot){
          if (Input::has($timeslot)){
            foreach ($formvalues[$timeslot] as $identifier){
              $presentation = Presentation::findOrFail(explode('_', $identifier)[1]);
              $presentation->timeslot = $timeslot;
              $presentation->save();
            }
          }
          //Here we 'unassign' presentations that were dropped back in the
          //unnasigned box
          if (Input::has('drag-elements')){
            foreach ($formvalues['drag-elements'] as $identifier){
              $presentation = Presentation::findOrFail(explode('_', $identifier)[1]);
              $presentation->timeslot = null;
              $presentation->save();
              }
            }
        }
      }
    return redirect()->route('timeslot.show', compact('display_room'));
    }
    //This method is for the admin to manually add timeslots from the scheduling
    //page
    public function createNewTimeslot($display_room){
      $formvalues = Input::all();
      $timeslot= new Timeslot;
      $timeslot->day = $formvalues['day'];
      $timeslot->room_code = $display_room;
      $conference = Conference::orderBy('id','desc')->first();
      $timeslot->conference_id = $conference->id;
      $time = strtotime($formvalues['minute']) + strtotime($formvalues['hour']);
      $timeslot->time = date('H:i', $time);
      $timeslot->save();
      return redirect()->route('timeslot.show', compact('display_room'));
    }

    public function addRoom($room){
      $conference = Conference::orderBy('id','desc')->first()->id;
      //Getting all unique times existing in this conference
      $times = Timeslot::where('conference_id', $conference)->
          select('time')->distinct()->get();
      $days = Timeslot::where('conference_id', $conference)->
          select('day')->distinct()->get();
      foreach($days as $day){
        foreach($times as $time){
          $timeslot = new Timeslot;
          $timeslot->conference_id = $conference;
          $timeslot->day = $day->day;
          $timeslot->time = $time->time;
          $timeslot->room_code = $room;
          $timeslot->save();
        }
      }
      return redirect()->route('room.index');
    }

    // Takes in the the room_code (a string) of the room to delete,
    // and deletes all timeslots having that room_code and having the current
    // conference.
    public function removeRoom($room){
      $conference = Conference::orderBy('id','desc')->first()->id;
      DB::table('timeslots')->where('room_code', $room)->
        where('conference_id', $conference)->delete();
      return redirect()->route('room.index');
    }

    public function deleteTime($display_room, $id){
      Timeslot::destroy($id);
      return redirect()->route('timeslot.show', compact('display_room'));
    }

    public function preview(){
      $rooms= Room::where("available", true)->get();
      $days = Timeslot::orderBy("id", 'desc')->first()->day;
      $presentations = Presentation::where(
          'conference_id', '=', get_current_conference_id())->whereNotNull('timeslot')->get();
      $timeslots = Timeslot::where(
          'conference_id', '=', get_current_conference_id())->get();
      return view('timeslots.preview', compact('timeslots', 'rooms', 'presentations', 'days'));
    }

}
