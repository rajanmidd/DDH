<?php

namespace App\Http\Controllers\agency;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\models\Agency;

class VerificationController extends Controller {

  /**
   * Function used to confirm email
   * @param type $token
   * @return type
   */
  public function confirmEmail($token) {
    
    $agencyDetail=Agency::whereTempAccessToken($token)->first();
    //dd($agencyDetail);die;
    if($agencyDetail)
    {
      $agencyDetail->confirmEmail();
      Session::flash('success', 'Congratulations!, Your email has been confrimed.');
    }
    else
    {
      Session::flash('error', 'Sorry, your link has been expired.');
    }
    
    return redirect('agency');
  }

}
