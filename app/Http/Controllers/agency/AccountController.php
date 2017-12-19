<?php

namespace App\Http\Controllers\merchant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\PharmacyBankDetails;
use App\Helpers\CustomHelper;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AccountController extends Controller
{
   use AuthenticatesUsers;
   
   /**
    * Function used to show the bank account details 
    * and also can update back account details.
    * 
    * @return type
    */
   public function index()
   {
      $phar_id=auth()->guard('merchant')->user()->id;
      $accountDetail=PharmacyBankDetails::where('phar_id',$phar_id)->first();
      return view('merchant.account.index',['accountDetail'=>$accountDetail]);
   }
   
   /**
    * Function used to update the inventory
    * 
    * @param Request $request
    */
   
   public function update(Request $request)
   {
      $validator=$this->validate($request, [
         'bank_name' => 'required',
         'account_number' => 'required',
         'swift_code' => 'required',
      ]);
      $data=$request->all();
      $phar_id=auth()->guard('merchant')->user()->id;
      $accountDetail=PharmacyBankDetails::where('phar_id',$phar_id)->first();
      if($accountDetail)
      {
         $accountDetail->bank_name=$data['bank_name'];
         $accountDetail->account_number=$data['account_number'];
         $accountDetail->swift_code=$data['swift_code'];
         if($accountDetail->save())
         {
            \Session::flash('success',\Lang::get('errorMessage.bank_account_update_sccuess'));
         }
         else
         {
            \Session::flash('error',\Lang::get('errorMessage.error_occurred'));
         }
      }
      else
      {
         $data['phar_id']=$phar_id;
         if(PharmacyBankDetails::create($data))
         {
            \Session::flash('success',\Lang::get('errorMessage.bank_account_update_sccuess'));
         }
         else
         {
            \Session::flash('error',\Lang::get('errorMessage.error_occurred'));
         }
      }     
      return redirect('merchant/manage-account');
   }
}
