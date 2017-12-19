<?php

namespace App\Http\Controllers\merchant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Feedback;
use App\models\Pharmacy;
use App\Helpers\CustomHelper;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Mail;

class FeedbackController extends Controller
{
   use AuthenticatesUsers;
   
   /**
    * Function used to show the feedback form
    * 
    * 
    * @return type
    */
   public function index()
   {
      return view('merchant.feedback.index');
   }
   
   public function store(Request $request)
   {
      $validator=$this->validate($request, [
         'feedback' => 'required',
      ]);
      $data=$request->all();
      $phar_id=auth()->guard('merchant')->user()->id;
      $data['phar_id']=$phar_id;
      if(Feedback::create($data))
      {
         $profileDetail=Pharmacy::where('id',$phar_id)->first();
         $data['name']=$profileDetail->name;
         $mail=Mail::send('emails.feedback', $data, function($message) use ($data)
         {
            $message->from('no-reply@site.com', "Med-Me");
            $message->subject("Feedback");
            $message->to(Config('constants.ADMIN_EMAIL'));
         });
         \Session::flash('success',\Lang::get('errorMessage.feedback_send_success'));
      }
      else
      {
         \Session::flash('error',\Lang::get('errorMessage.error_occurred'));
      }
      return redirect('merchant/feedback');
   }
}
