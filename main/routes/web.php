<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PremiumUserController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RPAController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/logout', function () {
    return view('welcome');
});

Route::get('/query', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware(['middleware'=>'PreventBackHistory'])->group(function () {
    Auth::routes();
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/verify',[RegisterController::class,'verifyUser'])->name('verify.name');
Route::get('/forgot-password',function(){
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed',
    ]);
 
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');


// // Google URL
// Route::prefix('google')->name('google.')->group( function(){
//     Route::get('login', [SocialAuthController::class, 'googleRedirect'])->name('login');
//     Route::any('callback', [SocialAuthController::class, 'callbackFromGoogle'])->name('callback');
// });


Route::group(['middleware'=>['isAdmin','auth','PreventBackHistory']], function(){
    Route::get('property-models',[RPAController::class,'index'])->name('property-models');
    Route::get('agent-models',[RPAController::class,'viewAgentModel'])->name('agent-models');
    Route::get('agent-models/create',[RPAController::class,'viewAgentModelCreate'])->name('agent-models.create');
    Route::post('agent-models/created',[RPAController::class,'createAgent'])->name('agent-models.created');

    Route::get('edit/{id}',[RPAController::class,'viewEditAgent']);
    Route::get('delete/{id}',[RPAController::class,'deleteAgent']);
    Route::post('edited',[RPAController::class,'editAgent']);
    Route::get('send/{id}',[MailController::class,'send']);

    Route::get('verifyrent/{id}',[RPAController::class,'verifyRent']);
    Route::get('verifysell/{id}',[RPAController::class,'verifySell']);
    Route::get('disapproverent/{id}',[RPAController::class,'disapproveRent']);
    Route::get('disapprovesell/{id}',[RPAController::class,'disapproveSell']);

     Route::get('rent-details/{id}',[RPAController::class,'viewRentDetails']);
   Route::get('sell-details/{id}',[RPAController::class,'viewSellDetails']);
   Route::get('Rent-Property',[RPAController::class,'viewRentProperties'])->name('Rent-Property');
Route::get('Sell-Property',[RPAController::class,'viewSellProperties'])->name('Sell-Property');

});

Route::group([ 'middleware'=>['isUser','auth','PreventBackHistory']], function(){
Route::get('property',[UserController::class,'index'])->name('property');

Route::get('premium-register',[UserController::class,'premiumRegister'])->name('premium-register');

Route::post('/pay',[UserController::class,'pay'])->name('pay');
Route::get('rent-property',[UserController::class,'viewRentProperties'])->name('rent-property');
Route::get('sell-property',[UserController::class,'viewSellProperties'])->name('sell-property');
Route::get('RentDetails/{id}',[UserController::class,'viewRentDetails']);
Route::get('SellDetails/{id}',[UserController::class,'viewSellDetails']);
Route::post('rentcomment',[UserController::class,'commentRent'])->name('rentcomment');
Route::post('sellcomment',[UserController::class,'commentSell'])->name('sellcomment');

Route::post('apply',[UserController::class,'rent'])->name('apply');
Route::post('bid',[UserController::class,'bid'])->name('bid');
Route::get('viewbid/{id}',[UserController::class,'viewbid']);

Route::get('/Rent-Details/{id}',[UserController::class,'showYourRentDetail']);
Route::get('/Sell-Details/{id}',[UserController::class,'showYourSellDetail']);
});

Route::group([ 'middleware'=>['isPremiumUser','auth','PreventBackHistory']], function(){
    Route::get('rent-property-models',[PremiumUserController::class,'index'])->name('rent-property-models');
    Route::get('rent-property-models/create',[PremiumUserController::class,'createRentForm'])->name('rent-property-models.create');
    Route::post('rent-property-models/created',[PremiumUserController::class,'createRent'])->name('rent-property-models.created');
    Route::get('rentdelete/{id}',[PremiumUserController::class,'deleteRentForm']);
    Route::post('rent-property-models/deleted',[PremiumUserController::class,'deleteRent'])->name('rent-property-models.deleted');
    Route::get('rentedit/{id}',[PremiumUserController::class,'editRentForm']);
    Route::post('rent-property-models/edited',[PremiumUserController::class,'editRent'])->name('rent-property-models.edited');
    Route::get('rentdetails/{id}',[PremiumUserController::class,'viewRentDetails']);
    Route::post('rent-comment',[PremiumUserController::class,'commentRent'])->name('rent-comment');
    Route::get('sell-property-models',[PremiumUserController::class,'viewSell'])->name('sell-property-models');
    Route::get('sell-property-models/create',[PremiumUserController::class,'createSellForm'])->name('sell-property-models.create');
    Route::post('sell-property-models/created',[PremiumUserController::class,'createSell'])->name('sell-property-models.created');
    Route::get('selldelete/{id}',[PremiumUserController::class,'deleteSellForm']);
    Route::post('sell-property-models/deleted',[PremiumUserController::class,'deleteSell'])->name('sell-property-models.deleted');
    Route::get('selledit/{id}',[PremiumUserController::class,'editSellForm']);
    Route::post('sell-property-models/edited',[PremiumUserController::class,'editSell'])->name('sell-property-models.edited');
    Route::get('selldetails/{id}',[PremiumUserController::class,'viewSellDetails']);
    Route::post('sell-comment',[PremiumUserController::class,'commentSell'])->name('sell-comment');
    Route::post('Property',[PremiumUserController::class,'viewYourProperties'])->name('Property');
    Route::get('Rent-property',[PremiumUserController::class,'viewRentProperties'])->name('Rent-property');
    Route::get('Sell-property',[PremiumUserController::class,'viewSellProperties'])->name('Sell-property');
    Route::get('detailsrent/{id}',[PremiumUserController::class,'rentDetails']);
    Route::get('detailssell/{id}',[PremiumUserController::class,'sellDetails']);
    Route::get('/viewApplier/{id}',[PremiumUserController::class,'viewApplier']);
    Route::get('/viewBidder/{id}',[PremiumUserController::class,'viewBidder']);
    Route::post('/applyForRent',[PremiumUserController::class,'rent'])->name('applyForRent');
    Route::post('/Bid',[PremiumUserController::class,'bid'])->name('Bid');
    Route::get('/acceptRent/{id}',[PremiumUserController::class,'acceptRent']);
    Route::get('/acceptBid/{id}',[PremiumUserController::class,'acceptBid']);
    Route::get('/your-property',[PremiumUserController::class,'yourProperty'])->name('your-property');
    Route::get('/Details-Rent/{id}',[PremiumUserController::class,'showYourRentDetail']);
Route::get('/Details-Sell/{id}',[PremiumUserController::class,'showYourSellDetail']);
});

Route::get('/agentlogin',[AgentController::class,'loginPage']);
Route::post('/loggedin',[AgentController::class,'login']);
Route::get('/property-models-agent',[AgentController::class,'showProperties'])->name('property-models-agent');;
Route::get('/agentlogout', function () {
    if(session()->has('name')){
        session()->pull('name');
        
     }
     return redirect('/');
});
Route::get('verifyRent/{id}',[AgentController::class,'verifyRent']);
    Route::get('verifySell/{id}',[AgentController::class,'verifySell']);
    Route::get('disapproveRent/{id}',[AgentController::class,'disapproveRent']);
    Route::get('disapproveSell/{id}',[AgentController::class,'disapproveSell']);

     Route::get('rentDetails/{id}',[AgentController::class,'viewRentDetails']);
   Route::get('sellDetails/{id}',[AgentController::class,'viewSellDetails']);
   Route::get('Rentproperty',[AgentController::class,'viewRentProperties'])->name('Rent-property');
    Route::get('Sellproperty',[AgentController::class,'viewSellProperties'])->name('Sell-property');
   
// // Google URL
// Route::prefix('google')->name('google.')->group( function(){
//     Route::get('login', [GoogleController::class, 'loginWithGoogle'])->name('login');
//     Route::any('callback', [GoogleController::class, 'callbackFromGoogle'])->name('callback');
// });sell-comment

Route::post('query',[MailController::class,'sendQueryMail'])->name('query');