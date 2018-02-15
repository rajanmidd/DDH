<?php

namespace App\Http\Controllers\agency;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Agency;
use App\models\AgencyDocuments;
use App\Helpers\CustomHelper;
use Illuminate\Contracts\Filesystem\Factory;
use Mail;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class RegisterController extends Controller {

  use AuthenticatesUsers;

  /**
   * Register the pharmacy
   * 
   * @param  string  $name
   * @param  string  $description
   * @param  string  $email
   * @param  string  $password
   * @param  string  $mobile
   * @param  string  $city
   * @param  string  $address
   */
  public function store(Request $request) {
    
    $verification_code = md5(str_random(64) . time() * 64);
    $data = $request->all();
    $data['temp_access_token'] = $verification_code;
    $data['password'] = bcrypt($data['password']);
    $data['terms_condition'] = (isset($data['terms_condition']) && $data['terms_condition']==1) ? '1': '0';
    $data['is_email_verified'] = '0';
    $agency = Agency::create($data);

    $agencyDocuments = array();
    $agencyDocuments['agency_id'] = $agency->id;
    if ($request->file('certificate_image')) {
      $certificate_image = $request->file('certificate_image');
      $image_url = CustomHelper::saveImageOnCloudanary($certificate_image);
      $agencyDocuments['certificate_image'] = $image_url;
    }

    if ($request->file('id_proof')) {
      $id_proof = $request->file('id_proof');
      $image_url = CustomHelper::saveImageOnCloudanary($id_proof);
      $agencyDocuments['id_proof'] = $image_url;
    }
    AgencyDocuments::insert($agencyDocuments);
    //Send Mail to Agency
    $mail = Mail::send('emails.welcome', $data, function($message) use ($data) {
      $message->from('dsn.geu@gmail.com', "GoWeeks");
      $message->subject("Email Verification From GoWeeks");
      $message->to($data['email']);
    });

    if (count(Mail::failures()) > 0) {
      return back()->withInput();
    } else {
      return redirect('agency/verification-pending');
    }
  }

  public function checkEmail(Request $request) {
    $data = $request->all();
    if (!empty($data['email'])) {
      $checkAgencyEmail = Agency::whereEmail($data['email']);
      if (auth()->guard('agency')->check()) {
        $agen_id = auth()->guard('agency')->user()->id;
        $checkAgencyEmail->where('id', '!=', $agen_id);
      }
      $checkAgencyEmail = $checkAgencyEmail->first();
      if (!empty($checkAgencyEmail)) {
        echo 'false';
      } else {
        echo 'true';
      }
    } else {
      echo 'false';
    }
  }

  public function checkEmailExists(Request $request) {
    $data = $request->all();
    if (!empty($data['email'])) {
      $checkPharmacyEmail = Pharmacy::whereEmail($data['email'])->first();
      if (!empty($checkPharmacyEmail)) {
        echo 'true';
      } else {
        echo 'false';
      }
    } else {
      echo 'false';
    }
  }

}
