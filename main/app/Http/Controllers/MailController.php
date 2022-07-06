<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SignupEmail;
use App\Mail\AgentEmail;
use App\Mail\QueryMail;
use App\Models\Agent;

class MailController extends Controller
{
    //\
    public static function sendSignupEmail($name,$email,$verification_code){
        $data=[
            'name'=>$name,
            'verification_code'=>$verification_code
        ];
        Mail::to($email)->send(new SignupEmail($data));

    }
    function send($id){
        $agent=Agent::find($id);
        $data=[
            'fullname'=>$agent->fullname,
            'email'=>$agent->email,
            'password'=>$agent->password
        ];
        Mail::to($agent->email)->send(new AgentEmail($data));

        return redirect()->route('agent-models');
    }

    function sendQueryMail(Request $req){
        $data=[
            'name'=>$req->name,
            'email'=>$req->email,
            'query'=>$req->query
        ];
          Mail::to($req->email)->send(new QueryMail($data));
         return redirect('/');
    }
}
