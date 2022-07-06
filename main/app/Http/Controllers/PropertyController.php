<?php

namespace App\Http\Controllers;
use App\Models\Seller;
use App\Models\User;
use App\Models\Admin;
use App\Models\Agent;
use App\Models\Rent_property_model;
use App\Models\Property_model;
use App\Models\Rent_location;
use App\Models\Sell_property_model;
use App\Models\Sell_location;
use App\Models\Rent_comment;
use App\Models\Sell_comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    public function showRentProperties(){
       $properties=Rent_property_model::where('owner_id','=',session()->get('loginID'))->get();
    //    $locations=[];
    //    foreach($properties as $property){
    //        $locations []=Rent_location::where('property_id','=',$property->id)->get();
    //    }
    return view('rent-property-models',['properties'=>$properties]);
    }
    public function showSellProperties(){
        $properties=Sell_property_model::where('owner_id','=',session()->get('loginID'))->get();
        //    $locations=[];
        //    foreach($properties as $property){
        //        $locations []=Rent_location::where('property_id','=',$property->id)->get();
        //    }
        return view('sell-property-models',['properties'=>$properties]);
       
    }
    public function viewRentEditForm($id){
        $property=Rent_property_model::find($id);
        $location=Rent_location::where('property_id','=',$id)->first();
       
        return view('edit-rent',['property'=>$property,'location'=>$location]);
    }
    public function editRent(Request $req){
        $req->validate([
            'name'=>'required',
            'image'=>'required',
            'type'=>'required',
            'address'=>'required',
            'description'=>'required',
            'price'=>'required | min:5 | max:8',
           
        ]);

        $rent=Rent_property_model::find($req->id);
        $rent->name=$req->name;
        if($req->hasFile('image')){
            $file=$req->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('images/', $filename);
            $rent->image= $filename;
        }
        $rent->type=$req->type;
        $rent->address=$req->address;
        $rent->description=$req->description;
        $rent->price=$req->price;
        
       
        $rent->save();

        $property=Property_model::where('rent_id','=',$req->id)->first();
        $property->name=$req->name;
        $property->image=$rent->image;
        $property->type=$req->type;
        $property->address=$req->address;
        $property->description=$req->description;
        $property->price=$req->price;
       
        
        $property->save();

        $location=Rent_location::where('property_id','=',$req->id)->first();
        $location->latitude=$req->latitude;
        $location->longitude=$req->longitude;
      
        $location->save();

        return redirect('/RentPropertyModels');


        
    }
    public function viewSellEditForm($id){
        $property=Sell_property_model::find($id);
        $location=Sell_location::where('property_id','=',$id)->first();
       
        return view('edit-sell',['property'=>$property,'location'=>$location]);
    }
    public function editSell(Request $req){
        $req->validate([
            'name'=>'required',
            'image'=>'required',
            'type'=>'required',
            'address'=>'required',
            'description'=>'required',
            'price'=>'required | min:5 | max:8',
           
        ]);

        $sell=Sell_property_model::find($req->id);
        $sell->name=$req->name;
        if($req->hasFile('image')){
            $file=$req->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('images/', $filename);
            $sell->image= $filename;
        }
        $sell->type=$req->type;
        $sell->address=$req->address;
        $sell->description=$req->description;
        $sell->price=$req->price;
        
       
        $sell->save();

        $property=Property_model::where('rent_id','=',$req->id)->first();
        $property->name=$req->name;
        $property->image=$sell->image;
        $property->type=$req->type;
        $property->address=$req->address;
        $property->description=$req->description;
        $property->price=$req->price;
       
        
        $property->save();

        $location=Sell_location::where('property_id','=',$req->id)->first();
        $location->latitude=$req->latitude;
        $location->longitude=$req->longitude;
      
        $location->save();

        return redirect('/SellPropertyModels');


        
    }
    public function rentProperties(){
        $admin=Admin::where('email','=',session()->get('loginID'))->first();
        $agent=Agent::where('email','=',session()->get('loginID'))->first();
        $seller=Seller::where('id','=',session()->get('loginID'))->first();
        $user=User::where('id','=',session()->get('loginID'))->first();
        $properties=Rent_property_model::where('property_status','=','verified')->get();
        return view('rent-properties',['seller'=>$seller,'user'=>$user,'admin'=>$admin,'agent'=>$agent,'properties'=>$properties]);
    }
    public function sellProperties(){
        $admin=Admin::where('email','=',session()->get('loginID'))->first();
        $agent=Agent::where('email','=',session()->get('loginID'))->first();
        $seller=Seller::where('id','=',session()->get('loginID'))->first();
        $user=User::where('id','=',session()->get('loginID'))->first();
        $properties=Sell_property_model::where('property_status','=','verified')->get();
        return view('sell-properties',['seller'=>$seller,'user'=>$user,'admin'=>$admin,'agent'=>$agent ,'properties'=>$properties]);
    }
    public function openRentForm(){
        return view('create-rent');
    }
    public function openSellForm(){
        return view('create-sell');
    }
    public function createRent(Request $req){

        $req->validate([
            'name'=>'required',
            'image'=>'required',
            'type'=>'required',
            'address'=>'required',
            'description'=>'required',
            'price'=>'required | min:4 | max:8',
           
        ]);
        $rent =new Rent_property_model();
        $rent->name=$req->name;
        if($req->hasFile('image')){
            $file=$req->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('images/', $filename);
            $rent->image= $filename;
        }
        $rent->type=$req->type;
        $rent->address=$req->address;
        $rent->description=$req->description;
        $rent->price=$req->price;
        $rent->property_status='pending';
        // $rent->sell_status='pending';
        $rent->owner_id=session()->get('loginID');
       
        $rent->save();

        $property=new Property_model();
        $property->name=$req->name;
        $property->image=$rent->image;
        $property->type=$req->type;
        $property->address=$req->address;
        $property->description=$req->description;
        $property->price=$req->price;
        $property->property_status='pending';
        // $property->sell_status='pending';
        $property->rent_id=$rent->id;
        $property->owner_id=$rent->owner_id;
        $property->save();

        $location=new Rent_location();
        $location->latitude=$req->latitude;
        $location->longitude=$req->longitude;
        $location->property_id=$property->rent_id;
        $location->save();

        return redirect('/RentPropertyModels');



        
    }

    public function createSell(Request $req){

        $req->validate([
            'name'=>'required',
            'image'=>'required',
            'type'=>'required',
            'address'=>'required',
            'description'=>'required',
            'price'=>'required | min:5 | max:8',
           
        ]);
        $sell =new Sell_property_model();
        $sell->name=$req->name;
        if($req->hasfile('image')){
            $file=$req->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('images/', $filename);
            $sell->image= $filename;
        }
        $sell->type=$req->type;
        $sell->address=$req->address;
        $sell->description=$req->description;
        $sell->price=$req->price;
        $sell->property_status='pending';
        // $sell->sell_status='pending';
        $sell->owner_id=session()->get('loginID');
        
        $sell->save();

        $property=new Property_model();
        $property->name=$req->name;
        $property->image=$sell->image;
        $property->type=$req->type;
        $property->address=$req->address;
        $property->description=$req->description;
        $property->price=$req->price;
        $property->property_status='pending';
        // $property->sell_status='pending';
        $property->sell_id=$sell->id;
        $property->owner_id=$sell->owner_id;
        $property->save();

        $location=new Sell_location();
        $location->latitude=$req->latitude;
        $location->longitude=$req->longitude;
        $location->property_id=$property->sell_id;
        $location->save();

        return redirect('/SellPropertyModels');

        
    }

    public function deleteRentForm($id){
        $property=Rent_property_model::find($id);
        return view('delete-rent',['property'=>$property]);
    }
    public function deleteRent(Request $req){
        $property=Rent_property_model::find($req->id);
        $property->delete();
        return redirect('/RentPropertyModels');
    }
    public function deleteSellForm($id){
        $property=Sell_property_model::find($id);
        return view('delete-sell',['property'=>$property]);
    }
    public function deleteSell(Request $req){
        $property=Sell_property_model::find($req->id);
        $property->delete();
        return redirect('/SellPropertyModels');
    }

    public function viewRentDetails($id){
        $admin=Admin::where('email','=',session()->get('loginID'))->first();
        $agent=Agent::where('email','=',session()->get('loginID'))->first();
        $seller=Seller::where('id','=',session()->get('loginID'))->first();
        $user=User::where('id','=',session()->get('loginID'))->first();
        $property=Rent_property_model::find($id);
        $location=Rent_location::where('property_id','=',$property->id)->first();
        $owner=Seller::where('id','=',$property->owner_id)->first();
        $iscomments=Rent_comment::where('property_id','=',$property->id)->first();
        $comments=Rent_comment::where('property_id','=',$property->id)->get();
        return view('rent-details',['property'=>$property,'location'=>$location,'owner'=>$owner,'iscomments'=>$iscomments,'comments'=>$comments
    ,'admin'=>$admin,'agent'=>$agent,'seller'=>$seller,'user'=>$user]);


    }
    public function rentComment(Request $req){
       $user=User::find(session()->get('loginID'));
        $comment=new Rent_comment();
        $comment->comment=$req->comment;
        $comment->commenter=$user->email;
        $comment->property_id=$req->id;
        $comment->save();
        return redirect('rentdetails/'.$req->id);

    }
    public function viewSellDetails($id){
        $admin=Admin::where('email','=',session()->get('loginID'))->first();
        $agent=Agent::where('email','=',session()->get('loginID'))->first();
        $seller=Seller::where('id','=',session()->get('loginID'))->first();
        $user=User::where('id','=',session()->get('loginID'))->first();
        $property=Sell_property_model::find($id);
        $location=Sell_location::where('property_id','=',$property->id)->first();
        $owner=Seller::where('id','=',$property->owner_id)->first();
        $iscomments=Sell_comment::where('property_id','=',$property->id)->first();
        $comments=Sell_comment::where('property_id','=',$property->id)->get();
        return view('sell-details',['property'=>$property,'location'=>$location,'owner'=>$owner,'iscomments'=>$iscomments,'comments'=>$comments
    ,'admin'=>$admin,'agent'=>$agent,'seller'=>$seller,'user'=>$user]);


    }
    public function sellComment(Request $req){
       $user=User::find(session()->get('loginID'));
        $comment=new Sell_comment();
        $comment->comment=$req->comment;
        $comment->commenter=$user->email;
        $comment->property_id=$req->id;
        $comment->save();
        return redirect('selldetails/'.$req->id);

    }
}
