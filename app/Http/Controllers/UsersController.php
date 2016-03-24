<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\PresentationType;
use App\Presentation;

class UsersController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        if($id == $user->id){
            $presentations = $user->presentations()->
            orderBy('updated_at','desc')->get();
            $courses = \App\Course::orderBy('subject_code', 'asc')->
                orderBy('number')->get();
            return view('user.show', compact('presentations', 'courses'));

        }
        else {
            flash()->error('You are not allowed to see others profiles!');
            return redirect(route('user.show', $user->id));
        }

    }

    public function add_course(Request $request){
        $user = Auth::user();
        $this->authorize('add_course', $user);

        try{
            $user->courses()->attach($request['course_id']);
            $user->save();
            flash()->success('Course added to your account!');
        } catch(\Illuminate\Database\QueryException $e){
            flash()->error('You already have this course');
        }

        return redirect(route('user.show', $user->id));
    }

    public function remove_course($id){
        $user = Auth::user();
        $this->authorize('remove_course', $user);

        try{
            $user->courses()->detach($id);
            $user->save();
            flash()->success('Course removed from your account!');
        } catch(\Illuminate\Database\QueryException $e){
            flash()->error("You don't have this course");
        }

        return redirect(route('user.show', $user->id));
    }

    public function test(){
      return view('user.test');
    }

    public function edit(){
      $user = Auth::user();
      return view('user._edit')->with('user', $user);
    }

    public function update(Request $request){
      $user = Auth::user();
      if($user->is_professor()){
        $presentations = Presentation::where('professor_name', $user->name)->get();
        foreach($presentations as $p){
          $p->professor_name=$request['name'];
          $p->save();
        }
      }
      $user->update($request->all());
      flash()->success("Your profile has been updated");
      return redirect(route('user.show', $user->id));

    }
}
