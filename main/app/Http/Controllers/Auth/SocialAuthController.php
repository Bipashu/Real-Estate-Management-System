<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function googleRedirect(){
        return Socialite::driver('google')->redirect();
 
    }
    public function callbackFromGoogle(){
        try {
            
            $user = \Socialite::driver('google')->stateless()->setHttpClient(new \GuzzleHttp\Client(['verify' => false])) ->user();
            $is_user=User::where('email',$user->getEmail())->first();
            if(!$is_user){
                $saveUser=User::updateOrCreate([
                    'google_id'=>$user->getId(),
    
                ],
                [
                    'name'=>$user->getName(),
                    'email'=>$user->getEmail(),
                    'password'=>Hash::make($user->getName().'0'.$user->getId())
                ]
            );

            }
            else{
                $saveUser=User::where('email',$user->getEmail())->update([
                    'google_id'=>$user->getId()
                ]);
                $saveUser = User::where('email', $user->getEmail())->first();

            }
            Auth::loginUsingId($saveUser->id);
            
            return redirect()->route('home');
        } catch (\Throwable $th) {
           throw $th;
        }
    }
}
