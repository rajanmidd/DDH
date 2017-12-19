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
    $activity_list = AgencyActivities::where("is_deleted",'1');
    
    if ($request->search_text <> '')
    {
      $activity_list->WhereRaw('(name LIKE "%' . $request->search_text. '%")');
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
    $data['open_time']=date("H:i",strtotime($data['open_time']));
    $data['close_time']=date("H:i",strtotime($data['close_time']));
    $data['season']=implode(',',$data['season']);
    $data['days']=implode(',',$data['days']);
    $id=AgencyActivities::create($data)->id;
    if($id)
    {
      \Session::flash('success',"Basic Information has been added successfully");
      return redirect('agency/add-activity/images/'.$id);
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
}
