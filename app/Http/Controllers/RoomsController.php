<?php

namespace App\Http\Controllers;


//use Illuminate\Http\Request;
use Request;
use App\Room;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class RoomsController extends Controller
{
    public function __construct(){
      $this->middleware('admin');
    }
    public function show(){
      $rooms= Room::all();
      return view('dashboard.room')->with('rooms', $rooms);
    }
    public function create(){
      return view('dashboard.addRoom');
    }

    public function store(){
      // $rooms= Room::all();
       $input = Request::all();
       $room = new Room();
       $room->code = $input['code'];
       $room->description = $input['description'];
       $room->save();
       //return view('dashboard.room')->with('rooms', $rooms);
       return redirect()->route('show_rooms');
    }

    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        //$this->authorize('modify', $room);

        $room->delete();
        //flash()->success("Room deleted!");

        return redirect()->route('show_rooms');
    }

    public function changeAvailability($id)
    {
      $room = Room::findOrFail($id);
      if ($room['available'] == 1){
        $room->available = 0;
      }
      else {
        $room->available = 1;
      }
      $room->save();
      return redirect()->route('show_rooms');
    }
}
