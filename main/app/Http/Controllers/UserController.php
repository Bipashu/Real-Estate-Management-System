<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use App\Models\Admin;
use App\Models\Agent;
use Hash;
use Illuminate\Support\Facades\Auth;
use Omnipay\Omnipay;
use App\Models\Payment;
use Stripe;
use Session;

use App\Models\Property_Model;
use App\Models\Rent_Property_Model;
use App\Models\Rent_location;
use App\Models\Rent_comment;
use App\Models\Sell_Property_Model;
use App\Models\Sell_location;
use App\Models\Sell_comment;
use App\Models\Rent_bid;
use App\Models\Sell_bid;

class UserController extends Controller
{
    
    public function index(Request $req){
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
        
          return view('property',['rents'=>$rents,'sells'=>$sells]);
        
    }

    public function premiumRegister(){
        return view('premium-register');
    }

   public function pay(Request $request){

    \Stripe\Stripe::setApiKey('sk_test_51KqBzyERTq7RZsxQ466NGzHe7tLVQ8ifRJ3fzIrHFF2pLvxIBbcArlXVFyuyV0thbBrTC7gcvEmPeTa5MPM5eYWz00cmPuwNkm');
        $customer = \Stripe\Customer::create(array(
          'name' => Auth::user()->name,
          'description' => 'Premium Registration Fee',
          'email' => Auth::user()->email,
          'source' => $request->input('stripeToken'),
           "address" => ["city" => "San Francisco", "country" => "US", "line1" => "510 Townsend St", "postal_code" => "98140", "state" => "CA"]

      ));
        try {
            \Stripe\Charge::create ( array (
                    "amount" => 100 * 100,
                    "currency" => "usd",
                    "customer" =>  $customer["id"],
                    "description" => "Premium Registration Fee"
            ) );
            Session::flash ( 'success-message', 'Payment done successfully !' );
            $payment=new Payment();
            $payment->payer_email=Auth::user()->email;
            $payment->amount=100;
            $payment->currency='usd';
            $payment->save();

            $user=User::find(Auth::user()->id);
            $user->role='premiumUser';
            $user->save();

            return view ( 'premium-register' );
        } catch ( \Stripe\Error\Card $e ) {
            Session::flash ( 'fail-message', $e->get_message() );
            return view ( 'premium-register' );
        }

   }

   function viewRentProperties(Request $req){
       $search=$req['search'] ?? "";
       if($search != ""){
        $properties=Rent_property_model::where('property_status','=','verified')->where('address','LIKE',"%$search%")->ORwhere('property_status','=','verified')->where('price','<=',$search)->get();
       }else{
        $properties=Rent_property_model::where('property_status','=','verified')->get();
       }
   
    return view('rent-properties',['properties'=>$properties]);
   }
   function viewSellProperties(Request $req){
    $search=$req['search'] ?? "";
    if($search != ""){
     $properties=Sell_property_model::where('property_status','=','verified')->where('address','LIKE',"%$search%")->ORwhere('property_status','=','verified')->where('price','<=',$search)->get();
    }else{
        $properties=Sell_property_model::where('property_status','=','verified')->get();
    }
   
    return view('sell-properties',['properties'=>$properties]);
}

function viewRentDetails($id){
       

    $property=Rent_property_model::find($id);
    $location=Rent_location::where('property_id','=',$property->id)->first();
    $owner=User::where('id','=',$property->owner_id)->first();
    $iscomments=Rent_comment::where('property_id','=',$property->id)->first();
    $comments=Rent_comment::where('property_id','=',$property->id)->get();
    $bids=Rent_bid::where('property_id','=',$property->id)->where('user_id','=',Auth::user()->id)->get();
    $isbids=Rent_bid::where('property_id','=',$property->id)->where('user_id','=',Auth::user()->id)->first();
    return view('rent-details-user',['property'=>$property,'location'=>$location,'owner'=>$owner,'iscomments'=>$iscomments,'comments'=>$comments,'bids'=>$bids,'isbids'=>$isbids]);

}
function viewSellDetails($id){
       

    $property=Sell_property_model::find($id);
    $location=Sell_location::where('property_id','=',$property->id)->first();
    $owner=User::where('id','=',$property->owner_id)->first();
    $iscomments=Sell_comment::where('property_id','=',$property->id)->first();
    $comments=Sell_comment::where('property_id','=',$property->id)->get();
    $bids=Sell_bid::where('property_id','=',$property->id)->where('user_id','=',Auth::user()->id)->get();
    $isbids=Sell_bid::where('property_id','=',$property->id)->where('user_id','=',Auth::user()->id)->first();
   
    return view('sell-details-user',['property'=>$property,'location'=>$location,'owner'=>$owner,'iscomments'=>$iscomments,'comments'=>$comments,'bids'=>$bids,'isbids'=>$isbids]);

}

public function commentRent(Request $req){
    $user=User::find(Auth::user()->id);
     $comment=new Rent_comment();
     $comment->comment=$req->comment;
     $comment->commenter=$user->email;
     $comment->property_id=$req->id;
     $comment->save();
     return redirect('RentDetails/'.$req->id);

 }
 public function commentSell(Request $req){
    $user=User::find(Auth::user()->id);
     $comment=new Sell_comment();
     $comment->comment=$req->comment;
     $comment->commenter=$user->email;
     $comment->property_id=$req->id;
     $comment->save();
     return redirect('SellDetails/'.$req->id);

 }

 public function rent(Request $req){
     $property=Rent_property_model::find($req->id);
     $rent=new Rent_bid();
     $rent->property_id=$req->id;
     $rent->user_id=Auth::user()->id;
    $rent->bid_amount=$property->price;
    $rent->save();
    return redirect('RentDetails/'.$req->id);


 }

 public function bid(Request $req){
    $property=Sell_property_model::find($req->id);
    $sell=new Sell_bid();
    $sell->property_id=$req->id;
    $sell->user_id=Auth::user()->id;
   $sell->bid_amount=$req->amount;
   $sell->save();
   return redirect('SellDetails/'.$req->id);


}

public function viewbid($id){
    $bids=Sell_bid::where('property_id','=',$id)->where('user_id','=',Auth::user()->id)->get();
    return view('bid',['bids'=>$bids]);
}

public function showYourRentDetail($id){
    $property=Rent_property_model::find($id);
    $owner=User::find($property->owner_id);
    $location=Rent_location::where('property_id','=',$property->id)->first();
    $iscomments=Rent_comment::where('property_id','=',$property->id)->first();
    $comments=Rent_comment::where('property_id','=',$property->id)->get();
    return view('rentdetails',['property'=>$property,'owner'=>$owner,'iscomments'=>$iscomments,'comments'=>$comments,'location'=>$location]);
}
public function showYourSellDetail($id){
    $property=Sell_property_model::find($id);
    $owner=User::find($property->owner_id);
    $location=Sell_location::where('property_id','=',$property->id)->first();
    $iscomments=Sell_comment::where('property_id','=',$property->id)->first();
    $comments=Sell_comment::where('property_id','=',$property->id)->get();
    return view('selldetails',['property'=>$property,'owner'=>$owner,'iscomments'=>$iscomments,'comments'=>$comments,'location'=>$location]);
}
    
}
