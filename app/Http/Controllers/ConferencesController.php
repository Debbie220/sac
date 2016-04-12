<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Conference;
use App\Presentation;
use App\Room;
use App\Timeslot;

class ConferencesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
    }

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

    public function create(){
        $times = [];
        $tNow = strtotime("10:00");
        $tEnd = strtotime("22:00");

        while($tNow < $tEnd){
            array_push($times, date("H:i", $tNow));
            $tNow = strtotime('+30 minutes',$tNow);
        }

        $days =[1,2,3,4,5];
        $numDays=1;
        return view('conferences.new', compact('days', 'times', 'numDays'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|min:5|max:255',
        ]);
        $conference = new Conference();
        $conference->name = $request['name'];
        $conference->save();
        $rooms = Room::where('available', true)->get();

        print_r($request->all());
        $first = $request['start_time'];
        $last = $request['end_time'];

        if(empty($first[0]) or empty($last[0])){
            flash()->error("You must add a start time and an end time");
            return back()->withInput();
        }

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
          for($day=1, $index=0; 
            $day<$numDays || $index<($numDays - 1); 
            $day++, $index++){
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
        return redirect()->route('user.show');
    }
}
