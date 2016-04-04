<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Room;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class RoomsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(){
        $rooms = Room::all();
        return view('rooms.index')->with('rooms', $rooms);
    }

    public function create(){
        return view('rooms.create');
    }

    public function store(Request $request){
        Room::create($request->all());
        flash()->success('Room created!');
        return redirect(route('room.index'));
    }

    public function destroy($code)
    {
        Room::destroy($code);
        flash()->success("Room deleted!");
        return redirect(route('room.index'));
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
      return redirect()->route('room.index');
    }
}
