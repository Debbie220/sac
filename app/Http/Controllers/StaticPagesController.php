<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use \Google_Client;
use App\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class StaticPagesController extends Controller
{
    public function home(){
        if(Auth::check())
            return redirect()->route('user.show', Auth::user());
        return view('static.home');
    }

    public function login(Request $request){
        $token = $request['id_token'];
        $user_data = $this->create_gclient($token);

        $user = User::firstOrCreate(['name' => $user_data['name'],
                'email' => $user_data['email']]);

        Auth::login($user);
        return redirect(route('user.show', $user));
    }

    public function logout(){
        if(Auth::check()){
            try{
                Auth::logout();
            } catch(\Illuminate\Database\QueryException $e){
                // It tries to update the remember token that's why it fails
            }
        }
        return redirect(route('home'));
    }

    private function create_gclient($token){
        $client_id = '813063530942-30qk2j5pbentenlho080oldb2pi2ljrn.apps.googleusercontent.com';
        $client_secret = 'BRsaasPaO-efqzc7zfC5g6d5';
        $redirect_uri = route('home');

        $client = new Google_Client();
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri($redirect_uri);
        $client->setScopes('email');

        $data = $client->verifyIdToken($token);
        return $data->getAttributes()['payload'];
    }
}
