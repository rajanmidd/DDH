<?php

namespace App\Http\Controllers\agency;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\ComboPackages;
use App\models\Itinerary;
use App\models\CampingService;
use App\models\ActivityUploads;
use App\Helpers\CustomHelper;

class ComboPackagesController extends Controller
{
    public function index(Request $request)
    {
        $agency_id=auth()->guard('agency')->user()->id;
        $combo_packages = ComboPackages::where("agency_id",$agency_id)->where("is_deleted",'1');
    
        // if ($request->search_text <> '')
        // {
        //   $activity_list->WhereRaw('(name LIKE "%' . $request->search_text. '%")');
        // }
        $combo_packages = $combo_packages->orderBy('id', 'desc')->paginate(10);
        return view('agency.comboPackages.index', ['combo_packages' => $combo_packages]);
    }

    public function addComboPackages()
    {
        return view('agency.comboPackages.addComboPackages');
    }

    public function saveComboPackage(Request $request)
    {
        $data=$request->all();
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // die;
        $comboData=array();
        $agency_id=auth()->guard('agency')->user()->id;
        $comboData['agency_id']=$agency_id;
        $comboData['combo_name']=$data['combo_name'];
        $comboData['combo_title']=$data['combo_title'];
        $comboData['combo_description']=$data['combo_description'];
        $comboData['combo_location']=$data['combo_location'];
        $comboData['latitude']=$data['latitude'];
        $comboData['longitude']=$data['longitude'];
        if(isset($data['camping']) && $data['camping']=="on")
        {
            $comboData['camping']='1';
            $comboData['camp_description']=$data['camp_description'];
            $comboData['days']=$data['days'];
            $comboData['night']=$data['night'];
            $comboData['triple_sharing']=$data['triple_sharing'];
            $comboData['double_sharing']=$data['double_sharing'];
        }
        else
        {
            $comboData['camping']='0';
            $comboData['price']=$data['price'];
        }
        
        $id=ComboPackages::create($comboData)->id;    
        if($id)
        {
            if(isset($data['itinerary']) && count($data['itinerary']) >0 && $data['itinerary'][0] !="")
            {
                foreach($data['itinerary'] as $key=>$value)
                {
                    $itinerary=new Itinerary();
                    $itinerary->camping_id=$id;
                    $itinerary->day_text=$value;
                    $itinerary->type='2';
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
                    $campingService->type='2';
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
                    $activityUploads->type='12';
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
                    $activityUploads->type='13';
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
                    $activityUploads->type='14';
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
                    $activityUploads->type='15';
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
                    $activityUploads->type='16';
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
                    $activityUploads->type='17';
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
                    $activityUploads->type='18';
                    $activityUploads->save();
                }
            }


            \Session::flash('success',"Congratulations, Combo package has been created successfully.");
            return redirect('agency/list-combo-packages');
        }
        else
        {
            \Session::flash('Error',"Sorry, error occurred. Please try again");
            return redirect('agency/list-combo-packages');
        }
        
    }

    public function deleteComboPackage(Request $request)
    {
        $data=$request->all();
        $comboDetail=ComboPackages::where("id",$data['id'])->first();
        $comboDetail->is_deleted='2';
        if($comboDetail->save())
        {
            \Session::flash('success',"Combo Package has been deleted successfully");
        }
        else
        {
            \Session::flash('error',"Error Occurred. Please try again.");
        }
        return redirect('agency/list-combo-packages');
    } 

    public function viewComboPackage($id)
    {
        $comboDetail=ComboPackages::where("id",$id)->first();
        return view('agency.comboPackages.viewComboPackages',['comboDetail'=>$comboDetail]);
    }

    public function editComboPackage($id=null)
    {
        $comboDetail=ComboPackages::where("id",$id)->first();
        return view('agency.comboPackages.editComboPackage',['comboDetail'=>$comboDetail]);
    }

    public function updateComboPackage(Request $request)
    {
        $data=$request->all();
       
        $id=$data['combo_id'];
        $comboDetail=ComboPackages::where("id",$id)->first();
        $comboDetail->combo_name=$data['combo_name'];
        $comboDetail->combo_title=$data['combo_title'];
        $comboDetail->combo_description=$data['combo_description'];
        $comboDetail->combo_location=$data['combo_location'];
        $comboDetail->latitude=$data['latitude'];
        $comboDetail->longitude=$data['longitude'];
        if(isset($data['camping']) && $data['camping']=="on")
        {
            $comboDetail->camping='1';
            $comboDetail->camp_description=$data['camp_description'];
            $comboDetail->days=$data['days'];
            $comboDetail->night=$data['night'];
            $comboDetail->triple_sharing=$data['triple_sharing'];
            $comboDetail->double_sharing=$data['double_sharing'];
        }
        else
        {
            $comboDetail->camping='0';
            $comboDetail->price=$data['price'];
        }
        if($comboDetail->save())
        {
            if(isset($data['itinerary']) && count($data['itinerary']) >0 && $data['itinerary'][0] !="")
            {
                Itinerary::where('camping_id',$id)->where('type','2')->delete();
                foreach($data['itinerary'] as $key=>$value)
                {
                    $itinerary=new Itinerary();
                    $itinerary->camping_id=$id;
                    $itinerary->day_text=$value;
                    $itinerary->type='2';
                    $itinerary->save();
                }
            }
            if(isset($data['service']) && count($data['service']) >0)
            {
                CampingService::where('camping_id',$id)->where('type','2')->delete();
                foreach($data['service'] as $key=>$value)
                {
                    $campingService=new CampingService();
                    $campingService->camping_id=$id;
                    $campingService->service_name=$key;
                    $campingService->service_value=json_encode($value);
                    $campingService->type='2';
                    $campingService->save();
                }
            }

            if(isset($data['meal']) &&  count($data['meal']) >0)
            {
                ActivityUploads::where('agency_activity_id',$id)->where('type','12')->delete();
                foreach($data['meal'] as $key=>$value)
                {
                    $activityUploads=new ActivityUploads();
                    $activityUploads->agency_activity_id=$id;
                    $activityUploads->file_url=$value;
                    $activityUploads->type='12';
                    $activityUploads->save();
                }
            }

            if(isset($data['inclusion']) &&  count($data['inclusion']) >0)            
            {
                ActivityUploads::where('agency_activity_id',$id)->where('type','13')->delete();
                foreach($data['inclusion'] as $key=>$value)
                {
                    $activityUploads=new ActivityUploads();
                    $activityUploads->agency_activity_id=$id;
                    $activityUploads->file_url=$value;
                    $activityUploads->type='13';
                    $activityUploads->save();
                }
            }

            if(isset($data['exclusion']) &&  count($data['exclusion']) >0)
            {
                ActivityUploads::where('agency_activity_id',$id)->where('type','14')->delete();
                foreach($data['exclusion'] as $key=>$value)
                {
                    $activityUploads=new ActivityUploads();
                    $activityUploads->agency_activity_id=$id;
                    $activityUploads->file_url=$value;
                    $activityUploads->type='14';
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
                    $activityUploads->type='15';
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
                    $activityUploads->type='16';
                    $activityUploads->save();
                }
            }

            if(isset($data['terms']) &&  count($data['terms']) >0)
            {
                ActivityUploads::where('agency_activity_id',$id)->where('type','17')->delete();
                foreach($data['terms'] as $key=>$value)
                {
                    $activityUploads=new ActivityUploads();
                    $activityUploads->agency_activity_id=$id;
                    $activityUploads->file_url=$value;
                    $activityUploads->type='17';
                    $activityUploads->save();
                }
            }

            if(isset($data['notes']) &&  count($data['notes']) >0)
            {
                ActivityUploads::where('agency_activity_id',$id)->where('type','18')->delete();
                foreach($data['notes'] as $key=>$value)
                {
                    $activityUploads=new ActivityUploads();
                    $activityUploads->agency_activity_id=$id;
                    $activityUploads->file_url=$value;
                    $activityUploads->type='18';
                    $activityUploads->save();
                }
            }

            \Session::flash('success',"Congratulations, Combo package has been updated successfully.");
            return redirect('agency/list-combo-packages');
        }
        else
        {
            \Session::flash('Error',"Sorry, error occurred. Please try again");
            return redirect('agency/list-combo-packages');
        }
    }

    public function updateComboBlockStatus($status,$packageId)
    {
        $comboDetail=ComboPackages::where("id",$packageId)->first();
        $comboDetail->is_blocked=$status;
        if($comboDetail->save())
        {
            \Session::flash('success',"Combo Package has been updated successfully");
        }
        else
        {
            \Session::flash('error',"Error Occurred. Please try again.");
        }
        return redirect('agency/list-combo-packages');
    }
}
