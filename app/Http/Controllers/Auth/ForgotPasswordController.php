<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use Mail;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;


    public function appforgetpass(Request $request){
        $data=$request->all();                
        
        $token = Str::random(64);
    
        $user=User::where('email',$request->email)->first();
        if($user) {       
            
            DB::table('password_resets')->insert([
                'email' => $request->email, 
                'token' => $token, 
                'created_at' => Carbon::now()
              ]);             
              
              Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
                $message->to($request->email);
                $message->subject('Reset Password');
            });    
            
            $response=array('response'=>'We have e-mailed your password reset link!. Please check your email.', 'field' => 'email', 'status'=>1);
            return json_encode($response);
        } else {
            $response=array('response'=>'Email entered is not registered in our records!', 'field' => 'email', 'status'=>0);
            return json_encode($response);
        }
    
        $data=array(
            'status'=>0,
        );
        
      // $get=Session::get('user');
      // dd($get);
        $response = array('response' => $data, 'status'=>1);
         //dd($response);
        return json_encode($response);
    }

    public function showResetPasswordForm($token) { 
        return view('auth.forgetPasswordLink', ['token' => $token]);
     }
 
     /**
      * Write code on Method
      *
      * @return response()
      */
     public function submitResetPasswordForm(Request $request)
     {
         $request->validate([
             'email' => 'required|email|exists:users',
             'password' => 'required|string|min:6|confirmed',
             'password_confirmation' => 'required'
         ]);
 
         $updatePassword = DB::table('password_resets')
                             ->where([
                               'email' => $request->email, 
                               'token' => $request->token
                             ])
                             ->first();
 
         if(!$updatePassword){
             return back()->withInput()->with('error', 'Invalid token!');
         }
 
         $user = User::where('email', $request->email)
                     ->update(['password' => Hash::make($request->password)]);

         DB::table('password_resets')->where(['email'=> $request->email])->delete();
 
         return redirect('/login')->with('message', 'Your password has been changed!');
     }
}
