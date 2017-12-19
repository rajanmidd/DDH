<?php

namespace App\Http\Controllers\merchant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Pharmacy;
use App\models\PharmacyTimings;
use App\models\PharmacyNotifications;
use App\models\PharmacyTax;
use App\Helpers\CustomHelper;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Mail;


class ProfileController extends Controller
{
   use AuthenticatesUsers;
   
   /**
    * Function used to show the profile details 
    * and also can update profile details.
    * 
    * @return type
    */
   public function index()
   {
      $phar_id=auth()->guard('merchant')->user()->id;
      $profileDetail=Pharmacy::where('id',$phar_id)->first();
      $days=CustomHelper::getDays();
      return view('merchant.profile.index',['profileDetail'=>$profileDetail,"days"=>$days]);
   }
   
   /**
    * Function used to update the profile details
    * 
    * @param Request $request
    */
   
   public function update(Request $request)
   {
      $validator=$this->validate($request, [
         'name' => 'required|max:100',
         'description' => 'required',
         'mobile' => 'required|integer',
         'city' => 'required',
         'address' => 'required',
         'latitude' => 'required',
         'longitude' => 'required',
      ]);
      $data=$request->all();
      $phar_id=auth()->guard('merchant')->user()->id;
      $profileDetail=Pharmacy::where('id',$phar_id)->first();
      $profileDetail->name=$data['name'];
      $profileDetail->description=$data['description'];
      $profileDetail->email=$data['email'];
      $profileDetail->mobile=$data['mobile'];
      $profileDetail->city=$data['city'];
      $profileDetail->address=$data['address'];
      $profileDetail->latitude=$data['latitude'];
      $profileDetail->longitude=$data['longitude'];
      
      $pharDocuments=$profileDetail->pharDocuments;
      
      $changeDoc=0;
      if($request->file('phar_image'))
      {
         $changeDoc=1;
         $phar_image=$request->file('phar_image');
         $image_url=CustomHelper::saveImageOnCloudanary($phar_image);
         $pharDocuments->phar_image=$image_url;
         $profileDetail->status='0';
      }
      if($request->file('license_image'))
      {
         $changeDoc=1;
         $license_image=$request->file('license_image');
         $image_url=CustomHelper::saveImageOnCloudanary($license_image);
         $pharDocuments->license_image=$image_url;
         $profileDetail->status='0';
      }
      
      if($changeDoc =='1')
      {  
         //Send Mail to Admin
         $Detail['email']=config('services.adminEmail');
         $Detail['subject']='Pharmacy Document';
         $Detail['name']=$data['name'];
         CustomHelper::sendMail('emails.changeDocument',$Detail); 
      }
      
      $pharDocuments->save();
      
      
      if($profileDetail->save())
      {
         PharmacyTimings::where('phar_id',$phar_id)->delete();
         $allTimings=array();
         foreach($data['day'] as $key=>$value)
         {
            $pharTimings=array();
            $pharTimings['phar_id']=$phar_id;
            $pharTimings['day']=$value;
            $pharTimings['open_time']=$data['open_time'][$key];
            $pharTimings['close_time']=$data['close_time'][$key];
            $allTimings[$key]=$pharTimings;
         }
         PharmacyTimings::insert($allTimings);
         
         $phar_tax=PharmacyTax::where('label','Delivery')->where('phar_id',$phar_id)->first();
         if($phar_tax)
         {
            $phar_tax->amount=$data['delivery_charges'];
            $phar_tax->save();
         }
         else
         {
            if($data['delivery_charges'])
            {
               $pharTax=array(
                  'phar_id'=>$phar_id,
                  'label'=>'Delivery',
                  'amount'=>$data['delivery_charges'],
                  'type'=>'2',
               );
               PharmacyTax::insert($pharTax);
            }
            
         }
         
         \Session::flash('success',\Lang::get('errorMessage.profile_update_sccuess'));
      }
      else
      {
         \Session::flash('error',\Lang::get('errorMessage.error_occurred'));
      }
         
      return redirect('merchant/view-profile');
   }
   
   /**
    * Function used to view the profile page
    * 
    * @return type
    */
   
   public function viewProfile()
   {
      $phar_id=auth()->guard('merchant')->user()->id;
      $profileDetail=Pharmacy::where('id',$phar_id)->first();
      $days=CustomHelper::getDays();
      return view('merchant.profile.viewProfile',['profileDetail'=>$profileDetail,"days"=>$days]);
   }
   
   
   /**
    * Function used to show change password form
    * 
    * @return type
    */
   
   public function password()
   {
      return view('merchant.profile.password');
   }
   
   
   
   /**
    * function used to update the password
    * 
    * @param Request $request
    */
   
   public function changePassword(Request $request)
   {
      $validator=$this->validate($request, [
         'old_password' => 'required',
         'new_password' => 'required',
         'confirm_new_password' => 'required|same:new_password',
      ]);
      
      $data=$request->all();
      $phar_id=auth()->guard('merchant')->user()->id;
      $pharmacyDetail=Pharmacy::findorfail($phar_id);
      if(\Hash::check($data['old_password'], $pharmacyDetail->password))
      {
         $pharmacyDetail->password=bcrypt($data['new_password']);
         $pharmacyDetail->save();
         
         \Session::flash('success',\Lang::get('errorMessage.password_changed_success'));
         //return redirect('merchant');
         return redirect('merchant/password');
      }
      else
      {
         return \Redirect::back()->withErrors(['Sorry, your old password is incorrect.']);
      }
   }
   
   /**
    * Function used to get unread notification
    * 
    * @return type
    */
   
   public function getUnreadNotification()
   {
      $phar_id=auth()->guard('merchant')->user()->id;
      $unreadNotification=PharmacyNotifications::where('phar_id',$phar_id)->where('is_read','0')->get();
      $html="";
      if(count($unreadNotification)>0)
      {
         foreach($unreadNotification as $key=>$value)
         {
            $html .='<li><a href="javascript:;"><span class="details"><span class="label label-sm label-icon label-warning"><i class="fa fa-bell-o"></i></span>'.substr($value->desciption,0,30).'...'.'</span><span class="time">'.$value->created_at->diffForHumans().'</span></a></li>';
         }
      }
      
      $res=array();
      $res['count']=count($unreadNotification);
      $res['messages']=$html;
      echo json_encode($res);
   }
}
