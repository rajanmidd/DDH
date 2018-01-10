<?php

namespace App\Http\Controllers\agency;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Agency;

class PasswordController extends Controller
{
   /**
    * Function used to check token is valid or not
    * @param type $token
    * @return type
    */
   
   public function checkToken($token)
   {
      $agencyDetail=Agency::whereTempAccessToken($token)->first();
      if($agencyDetail)
      {
         return view('agency.password.forgetPassword',["agencyDetail"=>$agencyDetail]);
      }
      else
      {
         return \Redirect::back()->withErrors(['Sorry, Invalid token. Please try again.']);
      }
   }
   
   /**
    * Function to chnage password
    * 
    * @param Request $request
    * @return type
    */
   
   public function changePassword(Request $request)
   {
      $data=$request->all();
      $agencyDetail=Agency::whereTempAccessToken($data['access_token'])->first();
      if($agencyDetail)
      {
         $agencyDetail->password=bcrypt($data['password']);
         $agencyDetail->save();
         \Session::flash('success','Congratulations!, Your password has been changed successfully. Please login again.');
         return redirect('agency');
      }
      else
      {
         return \Redirect::back()->withErrors(['Sorry, Invalid token. Please try again.']);
      }
   }
   
   
}
