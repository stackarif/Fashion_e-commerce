<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Otp;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use Exception;
use Vonage\SMS\Client;
use Nexmo;

class NexmoController extends Controller
{
    public function otp(){
        return view('Frontend.auth.otp');
    }


    public function otp_mail(Request $request){

        $code= rand(1111,9999);
        //dd($code);
        $user = new Customer;
        $user->phone=$request->phone;
        $user->code=$code;
        $user->save();

        $nexmo = app('Nexmo\Client');
        $nexmo->message()->send([
            'to'=> '+880'.(int) $request->phone,
            'from'=> 'Arif Hossain',
            'text'=> 'verify code: ' .$code,

        ]);
        return redirect('/verify');

    }
     public function verify(){
        return view('Frontend.auth.otp_verify');
     }

     public function post_verify(Request $request){
        $check= Otp::where('code',$request->code)->first();
        if($check){

            $check->code="";
            $check->save();

            // $request->authenticate();
            // $request->session()->regenerate();
    
           //return redirect()->intended(RouteServiceProvider::ADMIN_HOME);    
           return redirect('/');        

        }else{
            return back()->withMessage('Verify code is no correct');
        }
     }
    
}
