<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use \Google_Client;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class StaticPagesController extends Controller
{
    public function home(){
        if(Auth::check())
            return redirect()->route('user.show', Auth::user());
        return view('static.home');
    }

    public function test(Request $request){
        $client_id = '813063530942-30qk2j5pbentenlho080oldb2pi2ljrn.apps.googleusercontent.com';
        $client_secret = 'BRsaasPaO-efqzc7zfC5g6d5';
        $redirect_uri = route('home');

        $client = new Google_Client();
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri($redirect_uri);
        $client->setScopes('email');

        $data = $client->verifyIdToken($request['id_token']);
        print_r($data->getAttributes());
        return "success";
    }
}
