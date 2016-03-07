<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

use App\Http\Requests\PresentationRequest;

use App\Course;
use App\Presentation;
use App\PresentationType;

class PresentationsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin', ['only' => ['view_presentations_admin', 'approve_presentations']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TODO: Change this too
        return view('static.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $presentation = new Presentation();
        $presentation->type = -1;
        $presentation->course = null;
        $presentation = $this->setOwner($presentation);
        return $this->preapare_form($presentation, 'create');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\PresentationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PresentationRequest $request)
    {
        $presentation = new Presentation($request->all());
        $presentation = $this->setOwner($presentation);
        $presentation->save();
        flash()->success("Presentation saved. Don't forget to submit it to SAC coodinator");
        return redirect()->route('user.show', Auth::user());


    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $presentation = Presentation::findOrFail($id);
        return $this->preapare_form($presentation, 'edit');
    }

    /**
     * Submit the current presentation
     *
     * @param  \Illuminate\Http\Request\PresentationRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function submit($id)
    {
        $presentation = Presentation::findOrFail($id);
        $this->authorize('modify', $presentation);

        $presentation->set_submit(true);
        $presentation->set_approval(false);
        $presentation->save();

        flash()->success("Presentation submitted with success!");

        return redirect()->route('user.show', Auth::user());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\PresentationRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PresentationRequest $request, $id)
    {
        $presentation = Presentation::findOrFail($id);

        $this->authorize('modify', $presentation);

        $presentation->set_submit(false);
        $presentation->set_approval(false);
        $presentation->update($request->all());

        flash()->overlay("Don't forget to resubmit this update"
             ." to SAC coordinator", "Success!");

        return redirect()->route('user.show', Auth::user());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $presentation = Presentation::findOrFail($id);
        $this->authorize('modify', $presentation);

        $presentation->delete();
        flash()->success("Presentation deleted!");

        return redirect()->route('user.show', Auth::user());
    }

    private function preapare_form($presentation, $action)
    {
        $courses = Course::all();
        $presentation_types = PresentationType::all();
        return view('presentations.'.$action,
            compact('courses', 'presentation_types', 'presentation'));
    }


    private function setOwner($presentation){
        $user = Auth::user();

        if($user->is_student()){
            $presentation->student_name = $user->name;
        } else if($user->is_professor()){
            $presentation->professor_name = $user->name;
        }
        $presentation->owner = $user->id;
        return $presentation;
    }

    public function view_presentations_admin(){
      $presentations = Presentation::where('approved', false)->get();
      return view('dashboard.presentations')->with('presentations', $presentations);
    }

    public function approve_presentations($id){
      $presentation = Presentation::findOrFail($id);
      $presentation->approved=true;
      $presentation->save();
      flash()->success("This presentations has been approved");

      return redirect()->route('presentations');
    }
}
