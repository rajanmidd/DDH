<?php

namespace App\Http\Controllers\agency;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\CustomHelper;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Carbon\Carbon;

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
    return view('agency.dashboard.index');
  }
}
