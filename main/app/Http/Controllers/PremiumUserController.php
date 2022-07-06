<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Rent_property_model;
use App\Models\Sell_property_model;
use App\Models\Property_model;
use App\Models\Rent_location;
use App\Models\Sell_location;
use App\Models\User;
use App\Models\Rent_comment;
use App\Models\Sell_comment;
use App\Models\Rent_bid;
use App\Models\Sell_bid;
class PremiumUserController extends Controller
{
    function index(){
        $properties=Rent_property_model::where('owner_id','=',Auth::user()->id)->get();
        return view('rent-property-models',['properties'=>$properties]);
      
    }
    function viewSell(){
        $properties=Sell_property_model::where('owner_id','=',Auth::user()->id)->get();
        return view('sell-property-models',['properties'=>$properties]);
      
    }

    function createRentForm(){
        return view('create-rent');
      
    }

    function createSellForm(){
        return view('create-sell');
      
    }
    function createRent(Request $req){
        $req->validate([
            'name'=>'required | regex:/^[a-zA-Z]+$/u',
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
        $rent->owner_id=Auth::user()->id;
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
        $property->owner_id=Auth::user()->id;
        $property->save();

        $location=new Rent_location();
        $location->latitude=$req->latitude;
        $location->longitude=$req->longitude;
        $location->property_id=$rent->id;

       
       
        $location->save();

        return redirect()->route('rent-property-models');

        
      
    }
    function createSell(Request $req){
        $req->validate([
            'name'=>'required | regex:/^[a-zA-Z]+$/u',
            'image'=>'required',
            'type'=>'required',
            'address'=>'required',
            'description'=>'required',
            'price'=>'required | min:4 | max:8',
           
        ]);
        $sell =new Sell_property_model();
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
        $sell->property_status='pending';
        // $rent->sell_status='pending';
        $sell->owner_id=Auth::user()->id;
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
        $property->owner_id=Auth::user()->id;
        $property->save();

        $location=new Sell_location();
        $location->latitude=$req->latitude;
        $location->longitude=$req->longitude;
        $location->property_id=$sell->id;

       
       
        $location->save();

        return redirect()->route('sell-property-models');

        
      
    }

    function deleteRentForm($id){
        $property=Rent_property_model::find($id);
        return view('delete-rent',['property'=>$property]);
    }
    function deleteSellForm($id){
        $property=Sell_property_model::find($id);
        return view('delete-sell',['property'=>$property]);
    }

    function deleteRent(Request $req){
        $property=Rent_property_model::find($req->id);
        $property->delete();
        return redirect()->route('rent-property-models');
    }
    function deleteSell(Request $req){
        $property=Sell_property_model::find($req->id);
        $property->delete();
        return redirect()->route('sell-property-models');
    }

    function editRentForm($id){
        $property=Rent_property_model::find($id);
        $location=Rent_location::where('property_id','=',$id)->first();
       
        return view('edit-rent',['property'=>$property,'location'=>$location]);

    }
    function editSellForm($id){
        $property=Sell_property_model::find($id);
        $location=Sell_location::where('property_id','=',$id)->first();
       
        return view('edit-sell',['property'=>$property,'location'=>$location]);

    }
    function editRent(Request $req){
        $req->validate([
            'name'=>'required| regex:/^[a-zA-Z]+$/u',
            'image'=>'required',
            'type'=>'required',
            'address'=>'required',
            'description'=>'required',
            'price'=>'required | min:4 | max:8',
           
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

        return redirect()->route('rent-property-models');
        
    }
    function editSell(Request $req){
        $req->validate([
            'name'=>'required | regex:/^[a-zA-Z]+$/u',
            'image'=>'required',
            'type'=>'required',
            'address'=>'required',
            'description'=>'required',
            'price'=>'required | min:4 | max:8',
           
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

        $property=Property_model::where('sell_id','=',$req->id)->first();
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

        return redirect()->route('sell-property-models');
        
    }

    function viewRentDetails($id){
       

        $property=Rent_property_model::find($id);
        $location=Rent_location::where('property_id','=',$property->id)->first();
        $owner=User::where('id','=',$property->owner_id)->first();
        $iscomments=Rent_comment::where('property_id','=',$property->id)->first();
        $comments=Rent_comment::where('property_id','=',$property->id)->get();
        $bids=Rent_bid::where('property_id','=',$id)->get();
        
        $isbids=Rent_bid::where('property_id','=',$id)->first();

        return view('rent-details',['property'=>$property,'location'=>$location,'owner'=>$owner,'iscomments'=>$iscomments,'comments'=>$comments,'bids'=>$bids,'isbids'=>$isbids]);

    }

    function viewApplier($id){
        $bid=Rent_bid::find($id);
        $user=User::find($bid->user_id);
        return view('applier',['user'=>$user,'id'=>$bid->id]);

    }
    function viewSellDetails($id){
       

        $property=Sell_property_model::find($id);
        $location=Sell_location::where('property_id','=',$property->id)->first();
        $owner=User::where('id','=',$property->owner_id)->first();
        $iscomments=Sell_comment::where('property_id','=',$property->id)->first();
        $comments=Sell_comment::where('property_id','=',$property->id)->get();
        $bids=Sell_bid::where('property_id','=',$id)->get();
        $isbids=Sell_bid::where('property_id','=',$id)->first();
        return view('sell-details',['property'=>$property,'location'=>$location,'owner'=>$owner,'iscomments'=>$iscomments,'comments'=>$comments,'bids'=>$bids,'isbids'=>$isbids]);

    }

    function viewBidder($id){
        $bid=Sell_bid::find($id);
        $user=User::find($bid->user_id);
        return view('bidder',['user'=>$user,'id'=>$bid->id]);
    }
    public function commentRent(Request $req){
        $user=User::find(Auth::user()->id);
         $comment=new Rent_comment();
         $comment->comment=$req->comment;
         $comment->commenter=$user->email;
         $comment->property_id=$req->id;
         $comment->save();
         return redirect('rentdetails/'.$req->id);
 
     }
     public function commentSell(Request $req){
        $user=User::find(Auth::user()->id);
         $comment=new Sell_comment();
         $comment->comment=$req->comment;
         $comment->commenter=$user->email;
         $comment->property_id=$req->id;
         $comment->save();
         return redirect('selldetails/'.$req->id);
 
     }

     function viewRentProperties(Request $req){
        $search=$req['search'] ?? "";
        if($search != ""){
         $properties=Rent_property_model::where('property_status','=','verified')->where('address','LIKE',"%$search%")->ORwhere('property_status','=','verified')->where('price','<=',$search)->get();
        }else{
         $properties=Rent_property_model::where('property_status','=','verified')->get();
        }
      
        return view('rent-properties-premium',['properties'=>$properties]);
       }
       function viewSellProperties(Request $req){
        $search=$req['search'] ?? "";
        if($search != ""){
         $properties=Sell_property_model::where('property_status','=','verified')->where('address','LIKE',"%$search%")->ORwhere('property_status','=','verified')->where('price','<=',$search)->get();
        }else{
            $properties=Sell_property_model::where('property_status','=','verified')->get();
        }
       
        return view('sell-properties-premium',['properties'=>$properties]);
    }

    function rentDetails($id){
        $property=Rent_property_model::find($id);
    $location=Rent_location::where('property_id','=',$property->id)->first();
    $owner=User::where('id','=',$property->owner_id)->first();
    $iscomments=Rent_comment::where('property_id','=',$property->id)->first();
    $comments=Rent_comment::where('property_id','=',$property->id)->get();
    $bids=Rent_bid::where('property_id','=',$property->id)->where('user_id','=',Auth::user()->id)->get();
    $isbids=Rent_bid::where('property_id','=',$property->id)->where('user_id','=',Auth::user()->id)->first();
    return view('rent-details-premium',['property'=>$property,'location'=>$location,'owner'=>$owner,'iscomments'=>$iscomments,'comments'=>$comments,'bids'=>$bids,'isbids'=>$isbids]);

    }

    function sellDetails($id){
        $property=Sell_property_model::find($id);
    $location=Sell_location::where('property_id','=',$property->id)->first();
    $owner=User::where('id','=',$property->owner_id)->first();
    $iscomments=Sell_comment::where('property_id','=',$property->id)->first();
    $comments=Sell_comment::where('property_id','=',$property->id)->get();
    $bids=Sell_bid::where('property_id','=',$property->id)->where('user_id','=',Auth::user()->id)->get();
    $isbids=Sell_bid::where('property_id','=',$property->id)->where('user_id','=',Auth::user()->id)->first();
   
    return view('sell-details-premium',['property'=>$property,'location'=>$location,'owner'=>$owner,'iscomments'=>$iscomments,'comments'=>$comments,'bids'=>$bids,'isbids'=>$isbids]);

    }

    public function rent(Request $req){
        $property=Rent_property_model::find($req->id);
        $rent=new Rent_bid();
        $rent->property_id=$req->id;
        $rent->user_id=Auth::user()->id;
       $rent->bid_amount=$property->price;
       $rent->save();
       return redirect('detailsrent/'.$req->id);
   
   
    }

    public function bid(Request $req){
        $property=Sell_property_model::find($req->id);
        $sell=new Sell_bid();
        $sell->property_id=$req->id;
        $sell->user_id=Auth::user()->id;
       $sell->bid_amount=$req->amount;
       $sell->save();
       return redirect('detailssell/'.$req->id);
    
    
    }

    public function acceptRent($id){
        $bid=Rent_bid::find($id);
        $bid->status=1;
        $bid->save();
        $rent=Rent_property_model::find($bid->property_id);
        $rent->property_status='booked';
        $rent->save();
        $property=Property_model::where('rent_id','=',$bid->property_id)->first();
       $property->property_status='booked';
       $property->save();

        return redirect('rentdetails/'.$bid->property_id);
    }
    public function acceptBid($id){
        $bid=Sell_bid::find($id);
        $bid->status=1;
        $bid->save();
        $sell=Sell_property_model::find($bid->property_id);
        $sell->property_status='booked';
        $sell->save();
        $property=Property_model::where('sell_id','=',$bid->property_id)->first();
       $property->property_status='booked';
       $property->save();

        return redirect('selldetails/'.$bid->property_id);
    }

    public function yourProperty(){
        $bids=Rent_bid::where('status','=',1)->where('user_id','=',Auth::user()->id)->get();
        $rents=[];
        foreach($bids as $bid){
            $rent=Rent_property_model::find($bid->property_id);
            array_push($rents,$rent);
        }
        $bids=Sell_bid::where('status','=',1)->where('user_id','=',Auth::user()->id)->get();
        $sells=[];
        foreach($bids as $bid){
            $sell=Sell_property_model::find($bid->property_id);
            array_push($sells,$sell);
        }
        
          return view('your-property',['rents'=>$rents,'sells'=>$sells]);
    }

    public function showYourRentDetail($id){
        $property=Rent_property_model::find($id);
        $owner=User::find($property->owner_id);
        $location=Rent_location::where('property_id','=',$property->id)->first();
        $iscomments=Rent_comment::where('property_id','=',$property->id)->first();
        $comments=Rent_comment::where('property_id','=',$property->id)->get();
        return view('detailsrent',['property'=>$property,'owner'=>$owner,'iscomments'=>$iscomments,'comments'=>$comments,'location'=>$location]);
    }
    public function showYourSellDetail($id){
        $property=Sell_property_model::find($id);
        $owner=User::find($property->owner_id);
        $location=Sell_location::where('property_id','=',$property->id)->first();
        $iscomments=Sell_comment::where('property_id','=',$property->id)->first();
        $comments=Sell_comment::where('property_id','=',$property->id)->get();
        return view('detailssell',['property'=>$property,'owner'=>$owner,'iscomments'=>$iscomments,'comments'=>$comments,'location'=>$location]);
    }
}
