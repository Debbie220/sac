<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Course;

class CoursesController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function index(){
        $courses = Course::orderBy('subject_code')->
            orderBy('number')->paginate(10);
        return view('courses.index')->with('courses', $courses);
    }

    public function new_courses(){
        $courseSeeder = new \CourseTableSeeder();
        $courseSeeder->run();
        return redirect(route('course.index'));
    }
}
