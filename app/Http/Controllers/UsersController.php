<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Validator;

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
     * Display the current user.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user();
        $presentations = $user->presentations()->
        orderBy('updated_at','desc')->get();
        return view('user.show', compact('presentations'));
    }

    public function my_courses(){
        $courses = \App\Course::where('offered_this_semester', true)->
            orderBy('subject_code', 'asc')->
            orderBy('number')->get();
        $my_courses = Auth::user()->courses()->
            orderBy('subject_code', 'asc')->
            orderBy('number')->get();
        return view('user.professor.my_courses',
            compact('courses', 'my_courses'));
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

        return redirect(route('my_courses'));
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

        return redirect(route('my_courses'));
    }
}
