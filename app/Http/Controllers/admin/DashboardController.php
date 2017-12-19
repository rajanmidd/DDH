<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\User;
//use App\Helpers\CustomHelper;

class DashboardController extends Controller
{
   public function index()
   {
      $total_users=User::count();
      return view('admin.dashboard.index',['total_users'=>$total_users]);
   }
}
