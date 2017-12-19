<?php

namespace App\Http\Controllers\merchant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Pharmacy;

class PasswordController extends Controller
{
   /**
    * Function used to check token is valid or not
    * @param type $token
    * @return type
    */
   
   public function checkToken($token)
   {
      $pharmacyDetail=Pharmacy::whereTempAccessToken($token)->first();
      if($pharmacyDetail)
      {
         return view('merchant.password.forgetPassword',["pharmacyDetail"=>$pharmacyDetail]);
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
      $pharmacyDetail=Pharmacy::whereTempAccessToken($data['access_token'])->first();
      if($pharmacyDetail)
      {
         $pharmacyDetail->password=bcrypt($data['password']);
         $pharmacyDetail->save();
         \Session::flash('success','Congratulations!, Your password has been changed successfully. Please login again.');
         return redirect('merchant');
      }
      else
      {
         return \Redirect::back()->withErrors(['Sorry, Invalid token. Please try again.']);
      }
   }
   
   
}
