<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Course;

class CoursesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(Request $request){
        $courses = [];
        try{
            $title = $request->all()['title'];
            $subject = $request->all()['subject'];
            $number = $request->all()['number'];
        
            $courses = Course::where('title', 'like', '%'.$title.'%')->
                where('subject_code', 'like', '%'.$subject.'%')->
                where('number', 'like', '%'.$number.'%')->
                orderBy('subject_code')->orderBy('number')->paginate(10);
        } catch(\ErrorException $e){
            $courses = Course::orderBy('subject_code')->
                orderBy('number')->paginate(25);
        }
        return view('courses.index')->with('courses', $courses);
    }

    public function new_courses(){
        Course::where('offered_this_semester', true)->
            update(['offered_this_semester' => false]);
        $courseSeeder = new \CourseTableSeeder();
        $courseSeeder->run();
        return redirect(route('course.index'));
    }

}
