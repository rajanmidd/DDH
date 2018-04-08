<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\ActivityUnitType;
use App\models\Activity;
use App\Helpers\CustomHelper;

class ActivityController extends Controller
{
  public function listActivity(Request $request)
  {
    $activity_list=Activity::orderBy('id', 'desc');
    if($request->status <> '')
    {
      $activity_list->where('status',$request->status);
    }
    $activity_list = $activity_list->orderBy('id', 'desc')->paginate(10);
    
    return view('admin.activity.index', ['activity_list' => $activity_list]);
  }
  
  public function addActivity()
  {
    $unitType=ActivityUnitType::all();
    return view('admin.activity.add', ['unit_type_list' => $unitType]);
  }
  
  public function saveActivity(Request $request)
  {
    $validator=$this->validate($request, [
      'name' => 'required',
      'activity_image' => 'required',
   ]);
    $data=$request->all();
    $image = $request->file('activity_image');
    $data['activity_image'] = CustomHelper::saveImageOnCloudanary($image);
    if (Activity::create($data))
    {
      \Session::flash('success', "Activity has been created successfully");
    } 
    else
    {
      \Session::flash('error', "Something went wrong");
    }
    return redirect('admin/list-activity');
  }
  
  public function editActivity(Request $request)
  {
    $id=$request->id;
    $activityDetail=Activity::find($id);
    $unitType=ActivityUnitType::all();
    return view('admin.activity.edit', ['unit_type_list' => $unitType,'activityDetail'=>$activityDetail]);
  }
  
  public function updateActivity(Request $request)
  {
    $data=$request->all();
    $activityDetail=Activity::find($data['id']);
    $activityDetail->name=$data['name'];
    if($request->file('activity_image'))
    {
      $activityDetail->activity_image = CustomHelper::saveImageOnCloudanary($request->file('activity_image'));
    }
    if($activityDetail->save()) {
      \Session::flash('success', "Activity has been updated successfully");
    } else {
      \Session::flash('error', "Something went wrong. Please try again.");
    }
    return redirect('admin/list-activity');
  }
  
  public function deactivateActivity(Request $request)
  {
    $id=$request->id;
    $activityDetail=Activity::find($id);
    $activityDetail->status='0';
    if($activityDetail->save())
    {
      \Session::flash('success', "Activity has been deactivated successfully");
    } 
    else
    {
      \Session::flash('error', "Something went wrong. Please try again.");
    }
    return redirect('admin/list-activity');
  }
  
  public function activateActivity(Request $request)
  {
    $id=$request->id;
    $activityDetail=Activity::find($id);
    $activityDetail->status='1';
    if($activityDetail->save())
    {
      \Session::flash('success', "Activity has been activated successfully");
    } 
    else
    {
      \Session::flash('error', "Something went wrong. Please try again.");
    }
    return redirect('admin/list-activity');
  }
}
