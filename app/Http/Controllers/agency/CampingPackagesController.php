<?php

namespace App\Http\Controllers\agency;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\CampingPackages;
use App\models\Itinerary;
use App\models\CampingService;
use App\models\ActivityUploads;
use App\Helpers\CustomHelper;

class CampingPackagesController extends Controller
{
    public function index(Request $request)
    {
        $agency_id=auth()->guard('agency')->user()->id;
        $camping_packages = CampingPackages::where("agency_id",$agency_id)->where("is_deleted",'1');
    
        if ($request->status <> '' && $request->status==2)
        {
            $camping_packages->where('status','1');
        }

        if ($request->status <> '' && $request->status==3)
        {
            $camping_packages->where('is_blocked','2');
        }

        if ($request->status <> '' && $request->status==4)
        {
            $camping_packages->where('status','0');
        }

        if ($request->status <> '' && $request->status==5)
        {
            $camping_packages->where('status','2');
        }
        
        $camping_packages = $camping_packages->orderBy('id', 'desc')->paginate(10);
        return view('agency.campingPackages.index', ['camping_packages' => $camping_packages]);
    }

    public function addCampingPackages()
    {
        return view('agency.campingPackages.addCampingPackages');
    }

    public function saveCampingPackage(Request $request)
    {
        $data=$request->all();
        $campingData=array();
        $agency_id=auth()->guard('agency')->user()->id;
        $campingData['agency_id']=$agency_id;
        $campingData['camping_title']=$data['camping_title'];
        $campingData['camping_description']=$data['camping_description'];
        $campingData['camping_location']=$data['camping_location'];
        $campingData['latitude']=$data['latitude'];
        $campingData['longitude']=$data['longitude'];
        $campingData['days']=$data['days'];
        $campingData['night']=$data['night'];
        $campingData['triple_sharing']=$data['triple_sharing'];
        $campingData['double_sharing']=$data['double_sharing'];
        $id=CampingPackages::create($campingData)->id;    
        if($id)
        {
            if(isset($data['itinerary']) && count($data['itinerary']) >0 && $data['itinerary'][0] !="")
            {
                foreach($data['itinerary'] as $key=>$value)
                {
                    $itinerary=new Itinerary();
                    $itinerary->camping_id=$id;
                    $itinerary->day_text=$value;
                    $itinerary->type='1';
                    $itinerary->save();
                }
            }
            if(isset($data['service']) && count($data['service']) >0)
            {
                foreach($data['service'] as $key=>$value)
                {
                    $campingService=new CampingService();
                    $campingService->camping_id=$id;
                    $campingService->service_name=$key;
                    $campingService->service_value=json_encode($value);
                    $campingService->type='1';
                    $campingService->save();
                }
            }

            if(isset($data['meal']) &&  count($data['meal']) >0)
            {
                foreach($data['meal'] as $key=>$value)
                {
                    $activityUploads=new ActivityUploads();
                    $activityUploads->agency_activity_id=$id;
                    $activityUploads->file_url=$value;
                    $activityUploads->type='5';
                    $activityUploads->save();
                }
            }

            if(isset($data['inclusion']) &&  count($data['inclusion']) >0)
            {
                foreach($data['inclusion'] as $key=>$value)
                {
                    $activityUploads=new ActivityUploads();
                    $activityUploads->agency_activity_id=$id;
                    $activityUploads->file_url=$value;
                    $activityUploads->type='6';
                    $activityUploads->save();
                }
            }

            if(isset($data['exclusion']) &&  count($data['exclusion']) >0)
            {
                foreach($data['exclusion'] as $key=>$value)
                {
                    $activityUploads=new ActivityUploads();
                    $activityUploads->agency_activity_id=$id;
                    $activityUploads->file_url=$value;
                    $activityUploads->type='7';
                    $activityUploads->save();
                }
            }

            if(isset($data['activityImages']) && count($data['activityImages']) >0)
            {
                foreach($data['activityImages'] as $key=>$value)
                {
                    $image_url = CustomHelper::saveImageOnCloudanary($value);
                    $activityUploads=new ActivityUploads();
                    $activityUploads->agency_activity_id=$id;
                    $activityUploads->file_url=$image_url;
                    $activityUploads->type='8';
                    $activityUploads->save();
                }
            }

            if(isset($data['activityVideos']) &&count($data['activityVideos']) >0)
            {
                foreach($data['activityVideos'] as $key=>$value)
                {
                    $video_url = CustomHelper::saveImageOnCloudanary($value);
                    $activityUploads=new ActivityUploads();
                    $activityUploads->agency_activity_id=$id;
                    $activityUploads->file_url=$video_url;
                    $activityUploads->type='9';
                    $activityUploads->save();
                }
            }

            if(isset($data['terms']) &&  count($data['terms']) >0)
            {
                foreach($data['terms'] as $key=>$value)
                {
                    $activityUploads=new ActivityUploads();
                    $activityUploads->agency_activity_id=$id;
                    $activityUploads->file_url=$value;
                    $activityUploads->type='10';
                    $activityUploads->save();
                }
            }

            if(isset($data['notes']) &&  count($data['notes']) >0)
            {
                foreach($data['notes'] as $key=>$value)
                {
                    $activityUploads=new ActivityUploads();
                    $activityUploads->agency_activity_id=$id;
                    $activityUploads->file_url=$value;
                    $activityUploads->type='11';
                    $activityUploads->save();
                }
            }


            \Session::flash('success',"Congratulations, Camping package has been created successfully.");
            return redirect('agency/list-camping-packages');
        }
        else
        {
            \Session::flash('Error',"Sorry, error occurred. Please try again");
            return redirect('agency/list-camping-packages');
        }
        
    }

    public function deleteCampingPackage(Request $request)
    {
        $data=$request->all();
        $campingDetail=CampingPackages::where("id",$data['id'])->first();
        $campingDetail->is_deleted='2';
        if($campingDetail->save())
        {
            \Session::flash('success',"Camping Package has been deleted successfully");
        }
        else
        {
            \Session::flash('error',"Error Occurred. Please try again.");
        }
        return redirect('agency/list-camping-packages');
    } 

    public function viewCampingPackage($id)
    {
        $campingDetail=CampingPackages::where("id",$id)->first();
        return view('agency.campingPackages.viewCampingPackages',['campingDetail'=>$campingDetail]);
    }

    public function editCampingPackage($id=null)
    {
        $campingDetail=CampingPackages::where("id",$id)->first();
        return view('agency.campingPackages.editCampingPackage',['campingDetail'=>$campingDetail]);
    }

    public function updateCampingPackage(Request $request)
    {
        $data=$request->all();
        $id=$data['camping_id'];
        $campingDetail=CampingPackages::where("id",$id)->first();
        $campingDetail->camping_title=$data['camping_title'];
        $campingDetail->camping_description=$data['camping_description'];
        $campingDetail->days=$data['days'];
        $campingDetail->night=$data['night'];
        $campingDetail->camping_location=$data['camping_location'];
        $campingDetail->latitude=$data['latitude'];
        $campingDetail->longitude=$data['longitude'];
        $campingDetail->triple_sharing=$data['triple_sharing'];
        $campingDetail->double_sharing=$data['double_sharing'];
        if($campingDetail->save())
        {
            if(isset($data['itinerary']) && count($data['itinerary']) >0 && $data['itinerary'][0] !="")
            {
                Itinerary::where('camping_id',$id)->where('type','1')->delete();
                foreach($data['itinerary'] as $key=>$value)
                {
                    $itinerary=new Itinerary();
                    $itinerary->camping_id=$id;
                    $itinerary->day_text=$value;
                    $itinerary->type='1';
                    $itinerary->save();
                }
            }
            if(isset($data['service']) && count($data['service']) >0)
            {
                CampingService::where('camping_id',$id)->where('type','1')->delete();
                foreach($data['service'] as $key=>$value)
                {
                    $campingService=new CampingService();
                    $campingService->camping_id=$id;
                    $campingService->service_name=$key;
                    $campingService->service_value=json_encode($value);
                    $campingService->type='1';
                    $campingService->save();
                }
            }

            ActivityUploads::where('agency_activity_id',$id)->where('type','5')->delete();
            if(isset($data['meal']) &&  count($data['meal']) >0)
            {                
                foreach($data['meal'] as $key=>$value)
                {
                    $activityUploads=new ActivityUploads();
                    $activityUploads->agency_activity_id=$id;
                    $activityUploads->file_url=$value;
                    $activityUploads->type='5';
                    $activityUploads->save();
                }
            }
            
            ActivityUploads::where('agency_activity_id',$id)->where('type','6')->delete();
            if(isset($data['inclusion']) &&  count($data['inclusion']) >0)            
            {                
                foreach($data['inclusion'] as $key=>$value)
                {
                    $activityUploads=new ActivityUploads();
                    $activityUploads->agency_activity_id=$id;
                    $activityUploads->file_url=$value;
                    $activityUploads->type='6';
                    $activityUploads->save();
                }
            }

            ActivityUploads::where('agency_activity_id',$id)->where('type','7')->delete();
            if(isset($data['exclusion']) &&  count($data['exclusion']) >0)
            {                
                foreach($data['exclusion'] as $key=>$value)
                {
                    $activityUploads=new ActivityUploads();
                    $activityUploads->agency_activity_id=$id;
                    $activityUploads->file_url=$value;
                    $activityUploads->type='7';
                    $activityUploads->save();
                }
            }

            if(isset($data['activityImages']) && count($data['activityImages']) >0)
            {
                foreach($data['activityImages'] as $key=>$value)
                {
                    $image_url = CustomHelper::saveImageOnCloudanary($value);
                    $activityUploads=new ActivityUploads();
                    $activityUploads->agency_activity_id=$id;
                    $activityUploads->file_url=$image_url;
                    $activityUploads->type='8';
                    $activityUploads->save();
                }
            }

            if(isset($data['activityVideos']) &&count($data['activityVideos']) >0)
            {
                foreach($data['activityVideos'] as $key=>$value)
                {
                    $video_url = CustomHelper::saveImageOnCloudanary($value);
                    $activityUploads=new ActivityUploads();
                    $activityUploads->agency_activity_id=$id;
                    $activityUploads->file_url=$video_url;
                    $activityUploads->type='9';
                    $activityUploads->save();
                }
            }

            ActivityUploads::where('agency_activity_id',$id)->where('type','10')->delete();
            if(isset($data['terms']) &&  count($data['terms']) >0)
            {                
                foreach($data['terms'] as $key=>$value)
                {
                    $activityUploads=new ActivityUploads();
                    $activityUploads->agency_activity_id=$id;
                    $activityUploads->file_url=$value;
                    $activityUploads->type='10';
                    $activityUploads->save();
                }
            }

            ActivityUploads::where('agency_activity_id',$id)->where('type','11')->delete();
            if(isset($data['notes']) &&  count($data['notes']) >0)
            {                
                foreach($data['notes'] as $key=>$value)
                {
                    $activityUploads=new ActivityUploads();
                    $activityUploads->agency_activity_id=$id;
                    $activityUploads->file_url=$value;
                    $activityUploads->type='11';
                    $activityUploads->save();
                }
            }


            \Session::flash('success',"Congratulations, Camping package has been updated successfully.");
            return redirect('agency/list-camping-packages');
        }
        else
        {
            \Session::flash('Error',"Sorry, error occurred. Please try again");
            return redirect('agency/list-camping-packages');
        }
    }

    public function updateCampingBlockStatus($status,$packageId)
    {
        $campingDetail=CampingPackages::where("id",$packageId)->first();
        $campingDetail->is_blocked=$status;
        if($campingDetail->save())
        {
            \Session::flash('success',"Camping Package has been updated successfully");
        }
        else
        {
            \Session::flash('error',"Error Occurred. Please try again.");
        }
        return redirect('agency/list-camping-packages');
    }

    
}
