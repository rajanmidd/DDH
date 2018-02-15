<?php

namespace App\Http\Controllers\agency;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Helpers\CustomHelper;
use App\models\Agency;
use App\Http\Controllers\Controller;
use Mail;

class LoginController extends Controller
{
   use AuthenticatesUsers;   
   /**
    * Show the Login page for the user.
    * 
    * @return type
    */

   public function index()
   {
      if(auth()->guard('agency')->check())
      {
         return redirect()->route('agency.dashboard');
      }
      $days=CustomHelper::getDays();
      return view('agency.login.login',["days"=>$days]);
   } 
   
   /**
    * Show the Pending Verification page.
    * @return type
    */  
   
   public function verificationPending()
   {
      return view('agency.login.verificationPending');
   }
   
   /**
    * Show the Pending Verification page.
    * @return type
    */  
   
   public function verificationCompleted()
   {
      return view('agency.login.verificationCompleted');
   }
   
   /**
    * Function used for check the login functionality
    * 
    * @param Request $request
    */
   
   public function store(Request $request)
   {
      
      $validator=$this->validate($request, [
         'email' => 'required|email',
         'password' => 'required',
      ]);
      
      $data=$request->all();
      $agencyDetail=Agency::whereEmail($data['email'])->first();
      if(empty($agencyDetail))
      {
         return \Redirect::back()->withErrors(["Sorry, Your account doesn't exists."]);
      }
      else if(!\Hash::check($data['password'], $agencyDetail->password))
      {
         return \Redirect::back()->withErrors(["Sorry, your password is incorrect."]);
      }
      else if($agencyDetail->is_email_verified =='0')
      {
         return \Redirect::back()->withErrors(["Sorry, Your email is not verified."]);
      }
      else
      {
         $remember = (isset($data['remember']) && $data['remember'] =='1') ? true : false;
         if(\Auth::guard('agency')->attempt(['email' => $request->email, 'password' => $request->password,'is_email_verified'=>'1'],$remember)) 
         { 
            if($agencyDetail->status =='0')
            {
              return redirect()->route('agency.pending');
            }
            else if($agencyDetail->status =='2')
            {
              return redirect()->route('agency.rejected');            
            }
            else
            {
              return redirect()->route('agency.dashboard');
            }
            
         }      
         else
         {
            return \Redirect::back()->withErrors(["Error occurred. Please try again."]);
         }
      }    
   }
   
   /**
    * Function used for logout from the merchant panel
    * 
    * @return type
    */
   
   public function logout()
   {
      \Auth::guard('agency')->logout();
      return redirect('agency');
   }
   
   /**
    * Function to send email at the time of forget password.
    * 
    * @param Request $request
    * @return type
    */
   
   public function forgetPasswordMail(Request $request)
   {
      $verification_code=md5(str_random(64) . time()*64);
      $data=$request->all();
      $pharmacyDetail=Pharmacy::whereEmail($data['email'])->first();
      $pharmacyDetail->temp_access_token=$verification_code;
      if($pharmacyDetail->save())
      {
         $data['name']=$pharmacyDetail->name;
         $data['token']=$verification_code;
         $mail=Mail::send('emails.password', $data, function($message) use ($data)
         {
            $message->from('no-reply@site.com', "Med-Me");
            $message->subject("Change Password Request");
            $message->to($data['email']);
         });
         if( count(Mail::failures()) > 0 )
         {
            return back()->withInput();
         }
         else
         {
            \Session::flash('success','Email has been sent successfully. Please check your email for furthur process.');
            return redirect('agency');
         } 
      }     
   }

   public function accountPending()
   {
      return view('agency.login.pending');
   }

   public function accountRejected()
   {
      return view('agency.login.rejected');
   }
}
