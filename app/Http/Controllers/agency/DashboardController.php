<?php

namespace App\Http\Controllers\agency;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\CustomHelper;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Carbon\Carbon;
use App\models\AgencyActivities;

class DashboardController extends Controller
{

  use AuthenticatesUsers;

  /**
   * Function used to show the dashboard page after logged in
   * 
   * @return type
   */
  public function index()
  {
    $agency_id=auth()->guard('agency')->user()->id;
    $total_activities=AgencyActivities::where('agency_id',$agency_id)->get();
    return view('agency.dashboard.index',['total_activities'=>$total_activities]);
  }
}
