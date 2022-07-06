<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
      protected function redirectTo(){
          if( Auth()->user()->role == 'admin'){
              return route('property-models');
          }
          elseif( Auth()->user()->role == 'user'){
              return route('property');
          }
          elseif( auth()->user()->role == 'agent'){
            return route('agent.dashboard');
        }
        elseif( auth()->user()->role == 'premiumUser'){
            return route('rent-property-models');
        }
      }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
       $input = $request->all();
       $this->validate($request,[
           'email'=>'required|email',
           'password'=>'required'
       ]);

       if( auth()->attempt(array('email'=>$input['email'], 'password'=>$input['password'],'is_verified'=>1)) ){

        if( auth()->user()->role == 'admin'){
            return redirect()->route('property-models');
        }
        elseif( auth()->user()->role == 'user'){
            return redirect()->route('property');
        }
       elseif( auth()->user()->role == 'agent'){
            return redirect()->route('agent.dashboard');
        }
        elseif( auth()->user()->role == 'premiumUser'){
            return redirect()->route('rent-property-models');
        }

       }else{
           return redirect()->route('login')->with('error','Email and password are wrong');
       }
    }
}