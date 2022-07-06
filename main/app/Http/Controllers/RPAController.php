<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Agent;
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

class RPAController extends Controller

{
    function index()
    {
        // $admin=Admin::where('email','=',session()->get('loginID'))->first();
        // $agent=Agent::where('email','=',session()->get('loginID'))->first();
        $properties = Property_model::all();

        return view('property-models', ['properties' => $properties]);
    }

    function viewAgentModel()
    {
        $agents = Agent::all();

        return view('agent-models', ['agents' => $agents]);
    }

    function viewAgentModelCreate()
    {
        // $agents=User::where('role','=','agent')->get();


        return view('create-agent');
    }
    function createAgent(Request $req)
    {

        $req->validate([
            'email' => 'required|email|unique:agents',
            'fullname' => 'required|unique:agents',
            'password' => 'required',


        ]);


        $agent = new Agent;
        $agent->email = $req->email;
        $agent->fullname = $req->fullname;
        $agent->password = $req->password;
        $agent->save();
        return redirect()->route('agent-models');
    }
    function viewEditAgent($id)
    {
        $agent = Agent::find($id);
        return view('edit-agent', ['id' => $id, 'agent' => $agent]);
    }


    function viewCreateAgent()
    {
        return view('create-agent');
    }



    function editAgent(Request $req)
    {
        $req->validate([
            'email' => 'required|email',
            'fullname' => 'required',



        ]);

        $agent = Agent::find($req->id);
        $agent->email = $req->email;
        $agent->fullname = $req->fullname;
        $agent->save();
        return redirect()->route('agent-models');
    }



    function deleteAgent($id)
    {
        $agent = Agent::find($id);
        $agent->delete();
        return redirect()->route('agent-models');
    }



    function verifyRent($id)
    {
        $rent = Rent_property_model::find($id);
        $rent->property_status = 'verified';
        $rent->save();

        $property = Property_model::where('rent_id', '=', $id)->first();
        $property->property_status = 'verified';
        $property->save();

        return redirect()->route('property-models');
    }

    function verifySell($id)
    {
        $sell = Sell_property_model::find($id);
        $sell->property_status = 'verified';
        $sell->save();

        $property = Property_model::where('sell_id', '=', $id)->first();
        $property->property_status = 'verified';
        $property->save();

        return redirect()->route('property-models');
    }
    function disapproveRent($id)
    {
        $rent = Rent_property_model::find($id);
        $rent->property_status = 'disapproved';
        $rent->save();

        $property = Property_model::where('rent_id', '=', $id)->first();
        $property->property_status = 'disapproved';
        $property->save();

        return redirect()->route('property-models');
    }

    function disapproveSell($id)
    {
        $sell = Sell_property_model::find($id);
        $sell->property_status = 'disapproved';
        $sell->save();

        $property = Property_model::where('sell_id', '=', $id)->first();
        $property->property_status = 'disapproved';
        $property->save();

        return redirect()->route('property-models');
    }
    function viewRentDetails($id)
    {

        $property = Rent_property_model::find($id);
        $location = Rent_location::where('property_id', '=', $property->id)->first();
        $owner = User::where('id', '=', $property->owner_id)->first();
        $iscomments = Rent_comment::where('property_id', '=', $property->id)->first();
        $comments = Rent_comment::where('property_id', '=', $property->id)->get();
        return view('rent-details-admin', ['property' => $property, 'location' => $location, 'owner' => $owner, 'iscomments' => $iscomments, 'comments' => $comments]);
    }
    function viewSellDetails($id)
    {

        $property = Sell_property_model::find($id);
        $location = Sell_location::where('property_id', '=', $property->id)->first();
        $owner = User::where('id', '=', $property->owner_id)->first();
        $iscomments = Sell_comment::where('property_id', '=', $property->id)->first();
        $comments = Sell_comment::where('property_id', '=', $property->id)->get();
        return view('sell-details-admin', ['property' => $property, 'location' => $location, 'owner' => $owner, 'iscomments' => $iscomments, 'comments' => $comments]);
    }

    function viewRentProperties()
    {
        $properties = Rent_property_model::where('property_status', '=', 'verified')->get();
        return view('rent-properties-admin', ['properties' => $properties]);
    }
    function viewSellProperties()
    {
        $properties = Sell_property_model::where('property_status', '=', 'verified')->get();
        return view('sell-properties-admin', ['properties' => $properties]);
    }
}
