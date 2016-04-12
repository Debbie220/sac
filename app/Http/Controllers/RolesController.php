<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

use Auth;

class RolesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin', ['except' => 'new_role']);
    }

    public function index(){
        $users = User::where('requested_new_role', true)->get();
        return view('roles.index')->with('users', $users);
    }

    public function new_role(){
        $user = Auth::user();
        $this->authorize('request_new_role', $user);

        $user->requested_new_role = true;
        $user->save();
        flash("Request has been sent! Wait for administratror's approval");
        return redirect(route('user.show'));
    }

    public function approve($id){
        $user = User::findOrFail($id);
        $user->make_professor();
        return $this->modify($user, "has professor role now");
    }

    public function decline($id){
        $user = User::findOrFail($id);
        return $this->modify($user, "has been denied professor role");
    }

    private function modify($user, $message){
        $user->requested_new_role = false;
        $user->save();
        flash()->success($user->name . " " . $message);
        return redirect()->route('role.index');
    }
}
