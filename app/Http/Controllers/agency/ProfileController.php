<?php

namespace App\Http\Controllers\agency;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Agency;
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
        $agency_id=auth()->guard('agency')->user()->id;
        $profileDetail=Agency::where('id',$agency_id)->first();
        return view('agency.profile.index',['profileDetail'=>$profileDetail]);
    }
   
    /**
    * Function used to update the profile details
    * 
    * @param Request $request
    */
   
    public function update(Request $request)
    {
        $data=$request->all();
        $validator=$this->validate($request, [
            'owner_name' => 'required|max:100',
            'mobile' => 'required|integer',
            'email' => 'required',
            'address' => 'required'
        ]);
        
        $agency_id=auth()->guard('agency')->user()->id;
        $profileDetail=Agency::where('id',$agency_id)->first();
        $profileDetail->owner_name=$data['owner_name'];
        $profileDetail->email=$data['email'];
        $profileDetail->mobile=$data['mobile'];
        $profileDetail->address=$data['address'];
        $profileDetail->latitude=$data['latitude'];
        $profileDetail->longitude=$data['longitude'];
      
        $agencyDocuments=$profileDetail->agencyDocuments;
        
        $changeDoc=0;
        if ($request->file('certificate_image')) 
        {
            $changeDoc=1;
            $certificate_image = $request->file('certificate_image');
            $image_url = CustomHelper::saveImageOnCloudanary($certificate_image);
            $agencyDocuments->certificate_image = $image_url;
            $agencyDocuments->is_certificate_image_verified = '0';
            $profileDetail->is_document_verified='0';
        }

        if ($request->file('id_proof')) 
        {
            $changeDoc=1;
            $id_proof = $request->file('id_proof');
            $image_url = CustomHelper::saveImageOnCloudanary($id_proof);
            $agencyDocuments->id_proof = $image_url;
            $agencyDocuments->is_id_proof_verified = '0';
            $profileDetail->is_document_verified='0';
        }

        if($profileDetail->save())
        {
            if($changeDoc =='1')
            {  
                //Send Mail to Admin
                $Detail['email']=config('services.adminEmail');
                $Detail['subject']='Agency Document';
                $Detail['owner_name']=$data['owner_name'];
                CustomHelper::sendMail('emails.changeDocument',$Detail); 
            }      
            $agencyDocuments->save();
            \Session::flash('success',"Profile details has been updated successfully.");
        }
        else
        {
            \Session::flash('error',"Error occurred. Please try again.");
        }
         
         return redirect('agency/view-profile');
    }
   
   /**
    * Function used to view the profile page
    * 
    * @return type
    */
   
    public function viewProfile()
    {
        $agency_id=auth()->guard('agency')->user()->id;
        $profileDetail=Agency::where('id',$agency_id)->first();
        return view('agency.profile.viewProfile',['profileDetail'=>$profileDetail]);
    }
    
   
   /**
    * Function used to show change password form
    * 
    * @return type
    */
   
    public function password()
    {
        return view('agency.profile.password');
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
        $agency_id=auth()->guard('agency')->user()->id;
        $agencyDetail=Agency::findorfail($agency_id);
        if(\Hash::check($data['old_password'], $agencyDetail->password))
        {
            $agencyDetail->password=bcrypt($data['new_password']);
            $agencyDetail->save();
         
            \Session::flash('success',"Your password has been changed successfully");
            //return redirect('merchant');
            return redirect('agency/password');
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
