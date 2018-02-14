<?php

namespace App\Http\Controllers\agency;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Activity;
use App\models\ActivityUnitType;
use App\models\ActivityDifficultyLevel;
use App\models\AgencyActivities;
use App\Helpers\CustomHelper;
use App\models\ActivityUploads;

class ActivityController extends Controller
{

  public function index(Request $request)
  {
    $agency_id=auth()->guard('agency')->user()->id;
    $activity_list = AgencyActivities::where("is_deleted",'1')->where("agency_id",$agency_id);
    
    if ($request->status <> '' && $request->status==2)
    {
        $activity_list->where('status','1');
    }

    if ($request->status <> '' && $request->status==3)
    {
        $activity_list->where('is_blocked','2');
    }

    if ($request->status <> '' && $request->status==4)
    {
        $activity_list->where('status','0');
    }

    if ($request->status <> '' && $request->status==5)
    {
        $activity_list->where('status','2');
    }

    $activity_list = $activity_list->orderBy('id', 'desc')->paginate(10);
    return view('agency.activity.index', ['activity_list' => $activity_list]);
  }

  public function addActivity($page=null, $id=null)
  {
    if($page==null)
    {
      $page="information";
    }
    $activities=Activity::where('status','1')->pluck('name', 'id');
    $unitType=ActivityUnitType::where('status','1')->pluck('unit_name', 'id');
    $levels=ActivityDifficultyLevel::where('status','1')->pluck('name', 'id');
    return view('agency.activity.addActivity',['page'=>$page,'activities'=>$activities,'unitType'=>$unitType,'levels'=>$levels]);
  }

  public function saveActivityBasicInfo(Request $request)
  {
    $data=$request->all();
    $agency_id=auth()->guard('agency')->user()->id;
    $data['agency_id']=$agency_id;
    $data['location']=(string)$data['location'];
    $data['total_cost_after_discount']=$data['total_cost_after_discount']?$data['total_cost_after_discount']:0;
    $data['open_time']=date("H:i",strtotime($data['open_time']));
    $data['close_time']=date("H:i",strtotime($data['close_time']));
    $data['unit_type']=implode(',',$data['unit_type']);
    $data['unit_type_value']=json_encode($data['unit_type_value']);
    $data['season']=(isset($data['season'])) ? implode(',',$data['season']):"";
    $data['days']=(isset($data['days'])) ? implode(',',$data['days']):"";
    $id=AgencyActivities::create($data)->id;
    
    if($id)
    {
      /*****  Save Activity Images *****/
      if(isset($data['activityImages']) && count($data['activityImages']) >0)
      {
        foreach($data['activityImages'] as $key=>$value)
        {
          $image_url = CustomHelper::saveImageOnCloudanary($value);
          $activityUploads=new ActivityUploads();
          $activityUploads->agency_activity_id=$id;
          $activityUploads->file_url=$image_url;
          $activityUploads->type='1';
          $activityUploads->save();
        }
      }

      /*****  Save Activity Videos *****/
      if(isset($data['activityVideos']) && count($data['activityVideos']) >0)
      {
        foreach($data['activityVideos'] as $key=>$value)
        {
          $video_url = CustomHelper::saveImageOnCloudanary($value);
          $activityUploads=new ActivityUploads();
          $activityUploads->agency_activity_id=$id;
          $activityUploads->file_url=$video_url;
          $activityUploads->type='2';
          $activityUploads->save();
        }
      }

      /*****  Save Activity Terms *****/
      if(isset($data['terms']) && count($data['terms']) >0)
      {
        foreach($data['terms'] as $key=>$value)
        {
          $activityUploads=new ActivityUploads();
          $activityUploads->agency_activity_id=$id;
          $activityUploads->file_url=$value;
          $activityUploads->type='3';
          $activityUploads->save();
        }
      }

      /*****  Save Activity Notes *****/
      if(isset($data['notes']) && count($data['notes']) >0)
      {
        foreach($data['notes'] as $key=>$value)
        {
          $activityUploads=new ActivityUploads();
          $activityUploads->agency_activity_id=$id;
          $activityUploads->file_url=$value;
          $activityUploads->type='4';
          $activityUploads->save();
        }
      }
      \Session::flash('success',"Congratualtions, Activity has been added successfully");
      return redirect('agency/list-activity');
    }
    else
    {
      \Session::flash('Error',"Sorry, error occurred. Please try again");
      return redirect('agency/list-activity');
    }    
  }

  public function saveActivityImages(Request $request)
  {
    $data=$request->all();
    $id=$_POST['agency_activity_id'];
    if($id)
    {
      if(count($data['activityImages']) >0)
      {
        foreach($data['activityImages'] as $key=>$value)
        {
          $image_url = CustomHelper::saveImageOnCloudanary($value);
          $activityUploads=new ActivityUploads();
          $activityUploads->agency_activity_id=$id;
          $activityUploads->file_url=$image_url;
          $activityUploads->type='1';
          $activityUploads->save();
        }
        return redirect('agency/add-activity/videos/'.$id);
      }
      else
      {
        return redirect('agency/add-activity/images/'.$id);
      }
    }
    else
    {
      return redirect('agency/add-activity');
    }    
  }

  public function saveActivityVideos(Request $request)
  {
    ini_set('max_execution_time', 0);
    $data=$request->all();
    $id=$_POST['agency_activity_id'];
    if($id)
    {
      if(count($data['activityVideos']) >0)
      {
        foreach($data['activityVideos'] as $key=>$value)
        {
          $video_url = CustomHelper::saveImageOnCloudanary($value);
          $activityUploads=new ActivityUploads();
          $activityUploads->agency_activity_id=$id;
          $activityUploads->file_url=$video_url;
          $activityUploads->type='2';
          $activityUploads->save();
        }
        return redirect('agency/add-activity/terms/'.$id);
      }
      else
      {
        return redirect('agency/add-activity/videos/'.$id);
      }
    }
    else
    {
      return redirect('agency/add-activity');
    }    
  }

  public function saveActivityTerms(Request $request)
  {
    $data=$request->all();
    $id=$_POST['agency_activity_id'];
    if($id)
    {
      if(count($data['terms']) >0)
      {
        foreach($data['terms'] as $key=>$value)
        {
          $activityUploads=new ActivityUploads();
          $activityUploads->agency_activity_id=$id;
          $activityUploads->file_url=$value;
          $activityUploads->type='3';
          $activityUploads->save();
        }
        return redirect('agency/add-activity/notes/'.$id);
      }
      else
      {
        return redirect('agency/add-activity/terms/'.$id);
      }
    }
    else
    {
      return redirect('agency/add-activity');
    }    
  }


  public function saveActivityNotes(Request $request)
  {
    $data=$request->all();
    $id=$_POST['agency_activity_id'];
    if($id)
    {
      if(count($data['notes']) >0)
      {
        foreach($data['notes'] as $key=>$value)
        {
          $activityUploads=new ActivityUploads();
          $activityUploads->agency_activity_id=$id;
          $activityUploads->file_url=$value;
          $activityUploads->type='4';
          $activityUploads->save();
        }
        return redirect('agency/list-activity');
      }
      else
      {
        return redirect('agency/add-activity/notes/'.$id);
      }
    }
    else
    {
      return redirect('agency/add-activity');
    }    
  }

  public function deleteActivity(Request $request)
  {
    $data=$request->all();
    $activityDetail=AgencyActivities::where("id",$data['id'])->first();
    $activityDetail->is_deleted='2';
    if($activityDetail->save())
    {
      \Session::flash('success',"Activity has been deleted successfully");
    }
    else
    {
      \Session::flash('error',"Error Occurred. Please try again.");
    }
    return redirect('agency/list-activity');
  }

  public function viewActivity($id)
  {
    $activityDetail=AgencyActivities::where("id",$id)->first();
    return view('agency.activity.viewActivity',['activityDetail'=>$activityDetail]);
  }

  public function editActivity($page=null, $id=null)
  {
    $activityDetail=AgencyActivities::where("id",$id)->first();
    $activities=Activity::where('status','1')->pluck('name', 'id');
    $unitType=ActivityUnitType::where('status','1')->pluck('unit_name', 'id');
    $levels=ActivityDifficultyLevel::where('status','1')->pluck('name', 'id');
    return view('agency.activity.editActivity',['activityDetail'=>$activityDetail,'page'=>$page,'activities'=>$activities,'unitType'=>$unitType,'levels'=>$levels]);
  }

  public function updateActivityBasicInfo(Request $request)
  {
    $data=$request->all();
    $activityId=$data['agency_activity_id'];
    $activityDetail=AgencyActivities::where("id",$activityId)->first();
    $activityDetail->activity_id=$data['activity_id'];
    $activityDetail->title=$data['title'];
    $activityDetail->location=(string)$data['location'];
    $activityDetail->unit_type=implode(',',$data['unit_type']);
    $activityDetail->unit_type_value=json_encode($data['unit_type_value']);
    $activityDetail->difficult_level=$data['difficult_level'];
    // $activityDetail->minimum_amount_percent=$data['minimum_amount_percent'];
    $activityDetail->total_cost_after_discount=$data['total_cost_after_discount']?$data['total_cost_after_discount']:0;
    $activityDetail->price_per_person=$data['price_per_person'];
    $activityDetail->description=$data['description'];
    $activityDetail->latitude=$data['latitude'];
    $activityDetail->longitude=$data['longitude'];
    $activityDetail->open_time=date("H:i",strtotime($data['open_time']));
    $activityDetail->close_time=date("H:i",strtotime($data['close_time']));
    $activityDetail->season=(isset($data['season'])) ? implode(',',$data['season']):"";
    $activityDetail->days=(isset($data['days'])) ? implode(',',$data['days']):"";
    if($activityDetail->save())
    {
      if(isset($data['activityImages']) && count($data['activityImages']) >0)
      {
        foreach($data['activityImages'] as $key=>$value)
        {
          $image_url = CustomHelper::saveImageOnCloudanary($value);
          $activityUploads=new ActivityUploads();
          $activityUploads->agency_activity_id=$activityId;
          $activityUploads->file_url=$image_url;
          $activityUploads->type='1';
          $activityUploads->save();
        }
      }

      if(isset($data['activityVideos']) &&count($data['activityVideos']) >0)
      {
        foreach($data['activityVideos'] as $key=>$value)
        {
          $video_url = CustomHelper::saveImageOnCloudanary($value);
          $activityUploads=new ActivityUploads();
          $activityUploads->agency_activity_id=$activityId;
          $activityUploads->file_url=$video_url;
          $activityUploads->type='2';
          $activityUploads->save();
        }
      }
      ActivityUploads::where('agency_activity_id',$activityId)->where('type','3')->delete();
      if(isset($data['terms']) &&  count($data['terms']) >0)
      {        
        foreach($data['terms'] as $key=>$value)
        {
          $activityUploads=new ActivityUploads();
          $activityUploads->agency_activity_id=$activityId;
          $activityUploads->file_url=$value;
          $activityUploads->type='3';
          $activityUploads->save();
        }
      }

      ActivityUploads::where('agency_activity_id',$activityId)->where('type','4')->delete();
      if(isset($data['notes']) &&  count($data['notes']) >0)
      {        
        foreach($data['notes'] as $key=>$value)
        {
          $activityUploads=new ActivityUploads();
          $activityUploads->agency_activity_id=$activityId;
          $activityUploads->file_url=$value;
          $activityUploads->type='4';
          $activityUploads->save();
        }
      }
      \Session::flash('success',"Congratulations, Activity information has been updated successfully.");
      return redirect('agency/list-activity');
    }
    else
    {
      \Session::flash('Error',"Sorry, error occurred. Please try again");
      return redirect('agency/list-activity');
    }    
  }

  public function updateActivityTerms(Request $request)
  {
    $data=$request->all();
    $id=$_POST['agency_activity_id'];
    if($id)
    {
      if(count($data['terms']) >0)
      {
        ActivityUploads::where('agency_activity_id',$id)->where('type','3')->delete();
        foreach($data['terms'] as $key=>$value)
        {
          $activityUploads=new ActivityUploads();
          $activityUploads->agency_activity_id=$id;
          $activityUploads->file_url=$value;
          $activityUploads->type='3';
          $activityUploads->save();
        }
        return redirect('agency/edit-activity/notes/'.$id);
      }
      else
      {
        return redirect('agency/edit-activity/notes/'.$id);
      }
    }
    else
    {
      return redirect('agency/add-activity');
    }    
  }

  public function updateActivityNotes(Request $request)
  {
    $data=$request->all();
    $id=$_POST['agency_activity_id'];
    if($id)
    {
      if(count($data['notes']) >0)
      {
        ActivityUploads::where('agency_activity_id',$id)->where('type','4')->delete();
        foreach($data['notes'] as $key=>$value)
        {
          $activityUploads=new ActivityUploads();
          $activityUploads->agency_activity_id=$id;
          $activityUploads->file_url=$value;
          $activityUploads->type='4';
          $activityUploads->save();
        }
        return redirect('agency/list-activity');
      }
      else
      {
        return redirect('agency/list-activity');
      }
    }
    else
    {
      return redirect('agency/add-activity');
    }    
  }

  public function deleteActivityImage($id,$activityId)
  {
    ActivityUploads::where('id',$id)->delete();
    return redirect('agency/edit-activity/images/'.$activityId);
  }

  public function deleteActivityVideo($id,$activityId)
  {
    ActivityUploads::where('id',$id)->delete();
    return redirect('agency/edit-activity/videos/'.$activityId);
  }


  public function updateActivityImages(Request $request)
  {
    $data=$request->all();
    $id=$_POST['agency_activity_id'];
    if($id)
    {
      if(count($data['activityImages']) >0)
      {
        foreach($data['activityImages'] as $key=>$value)
        {
          $image_url = CustomHelper::saveImageOnCloudanary($value);
          $activityUploads=new ActivityUploads();
          $activityUploads->agency_activity_id=$id;
          $activityUploads->file_url=$image_url;
          $activityUploads->type='1';
          $activityUploads->save();
        }
        return redirect('agency/edit-activity/videos/'.$id);
      }
      else
      {
        return redirect('agency/edit-activity/videos/'.$id);
      }
    }
    else
    {
      return redirect('agency/add-activity');
    }    
  }

  public function updateActivityVideos(Request $request)
  {
    ini_set('max_execution_time', 0);
    $data=$request->all();
    $id=$_POST['agency_activity_id'];
    if($id)
    {
      if(count($data['activityVideos']) >0)
      {
        foreach($data['activityVideos'] as $key=>$value)
        {
          $video_url = CustomHelper::saveImageOnCloudanary($value);
          $activityUploads=new ActivityUploads();
          $activityUploads->agency_activity_id=$id;
          $activityUploads->file_url=$video_url;
          $activityUploads->type='2';
          $activityUploads->save();
        }
        return redirect('agency/edit-activity/terms/'.$id);
      }
      else
      {
        return redirect('agency/edit-activity/terms/'.$id);
      }
    }
    else
    {
      return redirect('agency/add-activity');
    }    
  }

  public function updateActivityBlockStatus($status,$activityId)
  {
    $activityDetail=AgencyActivities::where("id",$activityId)->first();
    $activityDetail->is_blocked=$status;
    if($activityDetail->save())
    {
      \Session::flash('success',"Activity staus has been updated successfully");
    }
    else
    {
      \Session::flash('error',"Error Occurred. Please try again.");
    }
    return redirect('agency/list-activity');
  }
}
