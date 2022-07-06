<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agent;
use App\Models\Admin;

use Hash;
use App\Models\Property_Model;
use App\Models\Rent_Property_Model;
use App\Models\Rent_location;
use App\Models\Rent_comment;
use App\Models\Sell_Property_Model;
use App\Models\Sell_location;
use App\Models\Sell_comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class AgentController extends Controller
{
    function loginPage(){
        return view('agent-login');
    }

    function login(Request $req){
        $req->validate([
            'email'=>'required|email',
            'password'=>'required',
           
          
           
        ]);

       $agents=Agent::all();

       foreach($agents as $agent){
           if($agent->email==$req->email && $agent->password==$req->password ){
              $req->session()->put('name',$agent->fullname);
              return redirect('property-models-agent');
           }
       }
       
    }
    function showProperties(){
        $properties=Property_model::all();
        return view('property-models-agent',['properties'=>$properties]);
    }
    function verifyRent($id){
        $rent=Rent_property_model::find($id);
        $rent->property_status='verified';
        $rent->save();

        $property=Property_model::where('rent_id','=',$id)->first();
        $property->property_status='verified';
        $property->save();

        return redirect()->route('property-models-agent');
    }

    function verifySell($id){
        $sell=Sell_property_model::find($id);
        $sell->property_status='verified';
        $sell->save();

        $property=Property_model::where('sell_id','=',$id)->first();
        $property->property_status='verified';
        $property->save();

        return redirect()->route('property-models-agent');
    }
    function disapproveRent($id){
        $rent=Rent_property_model::find($id);
        $rent->property_status='disapproved';
        $rent->save();

        $property=Property_model::where('rent_id','=',$id)->first();
        $property->property_status='disapproved';
        $property->save();

        return redirect()->route('property-models-agent');
    }

    function disapproveSell($id){
        $sell=Sell_property_model::find($id);
        $sell->property_status='disapproved';
        $sell->save();

        $property=Property_model::where('sell_id','=',$id)->first();
        $property->property_status='disapproved';
        $property->save();

        return redirect()->route('property-models-agent');
    }
    function viewRentDetails($id){
       
        $property=Rent_property_model::find($id);
        $location=Rent_location::where('property_id','=',$property->id)->first();
        $owner=User::where('id','=',$property->owner_id)->first();
        $iscomments=Rent_comment::where('property_id','=',$property->id)->first();
        $comments=Rent_comment::where('property_id','=',$property->id)->get();
        return view('rent-details-agent',['property'=>$property,'location'=>$location,'owner'=>$owner,'iscomments'=>$iscomments,'comments'=>$comments]);

    }
    function viewSellDetails($id){
       
        $property=Sell_property_model::find($id);
        $location=Sell_location::where('property_id','=',$property->id)->first();
        $owner=User::where('id','=',$property->owner_id)->first();
        $iscomments=Sell_comment::where('property_id','=',$property->id)->first();
        $comments=Sell_comment::where('property_id','=',$property->id)->get();
        return view('sell-details-agent',['property'=>$property,'location'=>$location,'owner'=>$owner,'iscomments'=>$iscomments,'comments'=>$comments]);

    }

    function viewRentProperties(){
        $properties=Rent_property_model::where('property_status','=','verified')->get();
        return view('rent-properties-agent',['properties'=>$properties]);
       }
       function viewSellProperties(){
        $properties=Sell_property_model::where('property_status','=','verified')->get();
        return view('sell-properties-agent',['properties'=>$properties]);
    }
}
