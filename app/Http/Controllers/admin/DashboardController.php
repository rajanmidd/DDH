<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\AgencyActivities;
use App\models\Agency;
use App\models\User;
//use App\Helpers\CustomHelper;

class DashboardController extends Controller
{
   public function index()
   {
      $pending_agency=Agency::where('status', '0')->count();
      $rejected_agency=Agency::where('status', '2')->count();
      $blocked_agency=Agency::where('is_block', '1')->count();
      $pending_activity=AgencyActivities::where("status",'0')->count();
      $blocked_activity=AgencyActivities::where("is_blocked",'2')->count();
      $deleted_activity=AgencyActivities::where("is_deleted",'2')->count();
      return view('admin.dashboard.index',['pending_agency'=>$pending_agency,'rejected_agency'=>$rejected_agency,'blocked_agency'=>$blocked_agency,'pending_activity'=>$pending_activity,'blocked_activity'=>$blocked_activity,'deleted_activity'=>$deleted_activity]);
   }

   public function getActivities(Request $request) {
      $status=$request->status;
      
      if ($request->status <> '' && $request->status == 1) {
         $activity_list = AgencyActivities::where("status",'0')->orderBy('id', 'desc')->paginate(10);
      } else if ($request->status <> '' && $request->status == 2) {
         $activity_list = AgencyActivities::where("is_blocked",'2')->orderBy('id', 'desc')->paginate(10);
      } else if ($request->status <> '' && $request->status == 3) {
         $activity_list = AgencyActivities::where("is_deleted",'2')->orderBy('id', 'desc')->paginate(10);
      } else {
         $activity_list = AgencyActivities::where("status",'1')->orderBy('id', 'desc')->paginate(10);
      }
      return view('admin.dashboard.activities', ['activity_list' => $activity_list]);
   }
}
