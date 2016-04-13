<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use DB;

use App\Http\Requests\PresentationRequest;

use App\Course;
use App\Presentation;
use App\Timeslot;
use App\PresentationType;
use App\Conference;
use App\User;
use JavaScript;

class PresentationsController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin',
            ['only' => ['index', 'approve', 'decline', 'pending']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($status = "Approved"){
        $status = strtoupper($status[0]);
        $presentations = Presentation::where(
            'conference_id', '=', get_current_conference_id())->
            where('status', '=', $status)->orderBy('course_id')->get();

        return view('presentations.index',
            compact('presentations', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $presentation = new Presentation();
        $presentation->type = null;
        $presentation->course = null;
        return $this->prepare_form($presentation, 'create');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\PresentationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PresentationRequest $request){
        if(!current_conference()){
            flash()->error("You can't create a presentation yet!");
            return redirect(route('user.show'));
        }
        $fields = $request->all();
        $students = $fields['student_name'];
        if(empty($students[0])){
            flash()->error("At least one student is required!");
            return back()->withInput();
        }
        unset($fields['student_name']);
        $user = Auth::user();

        $presentation = new Presentation($fields);
        $presentation->owner = $user->id;
        $presentation->conference_id = get_current_conference_id();
        if($user->is_admin()){
            $presentation->status = "A";
        }else {
            $presentation->status = "S";
        }


        if($presentation->save()){
            $this->save_students($students, $presentation->id);
            flash()->success("Presentation saved.");
        } else {
            flash()->error("Presentation couldn't be saved");
        }

        return redirect()->route('user.show');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $presentation = Presentation::findOrFail($id);
        return $this->prepare_form($presentation, 'edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\PresentationRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PresentationRequest $request, $id){
        $presentation = Presentation::findOrFail($id);

        $this->authorize('modify', $presentation);

        $fields = $request->all();
        $students = $fields['student_name'];
        if(empty($students[0])){
            flash()->error("At least one student is required!");
            return back()->withInput();
        }
        unset($fields['student_name']);
        $user = Auth::user();

        DB::table('presentation_students')->
            where('presentation_id', '=', $id)->delete();

        $this->save_students($students, $id);

        if($user->is_admin()){
            $presentation->status = "A";
            $presentation->update($fields);
            flash()->success("Presentation saved!");
        } else {
            $presentation->status = "S";
            $presentation->update($fields);
            flash()->overlay("Don't forget to resubmit this update"
                 ." to SAC coordinator", "Success!");
        }
        return redirect()->route('user.show');
    }

    /**
     * Submit the current presentation
     *
     * @param  \Illuminate\Http\Request\PresentationRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function submit($id){
        $presentation = Presentation::findOrFail($id);
        $this->authorize('modify', $presentation);

        $presentation->status = "P";
        $presentation->save();

        flash()->success("Presentation submitted with success!");

        return redirect()->route('user.show');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $presentation = Presentation::findOrFail($id);
        $this->authorize('modify', $presentation);

        $presentation->delete();
        flash()->success("Presentation deleted!");

        return redirect()->route('user.show');
    }

    public function approve($id){
        $presentation = Presentation::findOrFail($id);
        $presentation->status='A';
        $presentation->save();
        flash()->success("This presentations has been approved");

      return redirect()->route('presentation.status', 'pending');
    }

    public function decline($id){
        return view('presentations.comments')->with('id', $id);
    }

    public function save_comment($id, Request $request){
        $comments = $request->all();
        $presentation = Presentation::findOrFail($id);
        $presentation->status = 'D';
        $presentation->comments = $comments['comments'];
        $presentation->save();
        flash()->success('Your comments have being saved');
        return redirect()->route('presentation.status', 'pending');
    }

    private function save_students($students, $id){
        foreach ($students as $student) {
            try{
                DB::table('presentation_students')->insert(
                    ['presentation_id' => $id,
                    'student_name' => $student]);
            } catch(\Illuminate\Database\QueryException $e){
                flash()->error('This student is already
                    registered for this presentation');
            }
        }
    }

    private function prepare_form($presentation, $action){
        $user = Auth::user();

        if($user->is_professor())
            $courses = $user->courses()->where('offered_this_semester', true)->get();
        else
            $courses = Course::where('offered_this_semester', true)->
                orderBy('subject_code', 'asc')->
                orderBy('number')->get();

        $presentation_types = PresentationType::all();

        $students = $presentation->students();
        return view('presentations.'.$action,
            compact('courses', 'presentation_types', 'presentation', 'students'));
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

    public function addTime($display_room){
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
}
