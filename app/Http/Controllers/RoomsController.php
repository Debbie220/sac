<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Room;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class RoomsController extends Controller
{
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

    public function edit($code){
        $room = Room::findOrFail($code);
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, $code){
        $room = Room::findOrFail($code);
        $room->update($request->all());
        flash()->success('Room updated!');
        return redirect(route('room.index'));
    }


    public function destroy($code)
    {
        Room::destroy($code);
        flash()->success("Room deleted!");
        return redirect(route('room.index'));
    }

    public function changeAvaliability($id)
    {
      // $room = Room::findOrFail($id);
      print('got to this point');
    }
}
