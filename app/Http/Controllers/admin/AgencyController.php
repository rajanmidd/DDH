<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\CustomHelper;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\models\Agency;
use App\models\AgencyDocuments;
use App\models\AgencyActivities;
use App\models\CampingPackages;
use App\models\ComboPackages;

class AgencyController extends Controller
{

  public function index(Request $request)
  {
    $agency_list = Agency::where('is_deleted', '0');
    if ($request->status <> '' && $request->status == 0)
    {
      $agency_list->where('status', $request->status);
    }
    if ($request->status <> '' && $request->status == 1)
    {
      $agency_list->where('status', $request->status);
    }
    if ($request->status <> '' && $request->status == 2)
    {
      $agency_list->where('status', $request->status);
    }
    if ($request->search_text <> '')
    {
      $agency_list->WhereRaw('(owner_name LIKE "%' . $request->search_text . '%" or email LIKE "%' . $request->search_text . '%" or mobile LIKE "%' . $request->search_text . '%")');
    }
    $agency_list = $agency_list->orderBy('id', 'desc')->paginate(10);
    return view('admin.agency.index', ['agency_list' => $agency_list]);
  }

  /**
   * Function used to get Pharmacy profile details
   *    
   * @return type
   */
  public function agencyProfile(Request $request)
  {
    $agencyDetail = Agency::where('id', $request->id)->first();
    return view('admin.agency.profile', ["agencyDetail" => $agencyDetail]);
  }

  public function uploadAgencyImage(Request $request)
  {
    $image = $request->file('IDProof');
    $docType = $request->uploadType;
    $check_image = AgencyDocuments::where('agency_id', $request->ID)->first();
    if (isset($check_image))
    {
      $image = CustomHelper::saveImageOnCloudanary($image);
      $agencyDetails = AgencyDocuments::where('agency_id', $request->ID)->first();
      $agencyDetails->$docType = $image;
      if ($agencyDetails->save())
      {
        \Session::flash('success', "Image has been uploaded successfully");
      } else
      {
        \Session::flash('error', "Error occurred. Please try again.");
      }
    } else
    {
      $image = CustomHelper::saveImageOnCloudanary($image);
      $agencyDetails[$docType] = $image;
      $remaining_field = $docType == 'certificate_image' ? 'id_proof' : 'certificate_image';
      $agencyDetails[$remaining_field] = '';
      $agencyDetails['agency_id'] = $request->ID;
      if (AgencyDocuments::create($agencyDetails))
      {
        \Session::flash('success', "Image has been uploaded successfully");
      } else
      {
        \Session::flash('error', "Error occurred. Please try again.");
      }
    }
    return redirect('admin/agency-profile?id=' . $request->ID);
  }

  public function agencyAcceptReject(Request $request)
  {
    $agency_id = $request->agency_id_field;
    $reason = $request->reason;
    $status = $request->agency_status;
    if ($status == 1)
    {
      if ($agency_id && $reason && $status)
      {
        $agencyDetail = Agency::where('id', $agency_id)->first();

        $agencyDetail->status = $status;
        $agencyDetail->rejection_message = $reason;

        if ($agencyDetail->save())
        {
          \Session::flash('success', "Accepted successfully");
        } else
        {
          \Session::flash('error', "Something went wrong");
        }
      } else
      {
        \Session::flash('error', "Something went wrong");
      }
      return redirect('admin/agency-profile?id=' . $request->agency_id_field);
    }

    if ($status == 2)
    {
      if ($agency_id && $reason && $status)
      {
        $agencyDetail = Agency::where('id', $agency_id)->first();

        $agencyDetail->status = $status;
        $agencyDetail->rejection_message = $reason;
        if ($agencyDetail->save())
        {
          \Session::flash('success', "Rejected successfully");
        } else
        {
          \Session::flash('error', "Something went wrong");
        }
      } else
      {
        \Session::flash('error', "Something went wrong");
      }
      return redirect('admin/agency-profile?id=' . $request->agency_id_field);
    }
  }

  /**
   * Function used to block Pharmacy
   *    
   * @return type
   */
  public function blockAgency(Request $request)
  {
    $agencyDetail = Agency::where('id', $request->id)->first();
    $agencyDetail->is_block = '1';
    if ($agencyDetail->save())
    {
      \Session::flash('success', "Agency has been blocked successfully.");
    } else
    {
      \Session::flash('error', "Something went wrong.");
    }
    return redirect('admin/list-agency');
  }

  /**
   * Function used to unblock Pharmacy
   *    
   * @return type
   */
  public function unBlockAgency(Request $request)
  {
    $agencyDetail = Agency::where('id', $request->id)->first();
    $agencyDetail->is_block = '0';
    if ($agencyDetail->save())
    {
      \Session::flash('success', "Agency has been un-blocked successfully.");
    } else
    {
      \Session::flash('error', "Something went wrong.");
    }
    return redirect('admin/list-agency');
  }

  public function listActivity(Request $request,$id)
  {
    $agency_id=$id;
    $activity_list = AgencyActivities::where("is_deleted",'1')->where('agency_id',$agency_id);
    
    if ($request->search_text <> '')
    {
      $activity_list->WhereRaw('(name LIKE "%' . $request->search_text. '%")');
    }
    $activity_list = $activity_list->orderBy('id', 'desc')->paginate(10);
    return view('admin.agency.agencyActivities', ['activity_list' => $activity_list]);
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
    return redirect('admin/list-agency-activity');
  }

  public function viewActivity($id)
  {
    $activityDetail=AgencyActivities::where("id",$id)->first();
    return view('admin.agency.viewActivity',['activityDetail'=>$activityDetail]);
  }

  public function updateActivityStatus($status,$agencyId,$activityId)
  {
    $activityDetail=AgencyActivities::where("id",$activityId)->first();
    $activityDetail->status=$status;
    if($activityDetail->save())
    {
      \Session::flash('success',"Activity status has been updated successfully");
    }
    else
    {
      \Session::flash('error',"Error Occurred. Please try again.");
    }
    return redirect('admin/list-agency-activity/'.$agencyId);
  }

  public function listCampingPackages(Request $request)
  {
    $data=$request->all();
    $agency_id=\Request::segment(3);
    $camping_packages = CampingPackages::where("is_deleted",'1')->where('agency_id',$agency_id);
    if ($request->search_text <> '')
    {
      $camping_packages->WhereRaw('(name LIKE "%' . $request->search_text. '%")');
    }
    $camping_packages = $camping_packages->orderBy('id', 'desc')->paginate(10);
    return view('admin.agency.agencyCampingPackages', ['camping_packages' => $camping_packages]);
  }
  
  public function viewCampingPackage($agencyId,$packageId)
  {
    $campingDetail=CampingPackages::where("id",$packageId)->first();
    return view('admin.agency.viewCampingPackages',['campingDetail'=>$campingDetail]);
  }

  public function deleteCampingPackage($agencyId,$packageId)
  {
    $campingDetail=CampingPackages::where("id",$packageId)->first();
    $campingDetail->is_deleted='2';
    if($campingDetail->save())
    {
        \Session::flash('success',"Camping Package has been deleted successfully");
    }
    else
    {
        \Session::flash('error',"Error Occurred. Please try again.");
    }
    return redirect('admin/list-camping-packages/'.$agencyId);
  }


  public function updateCampingPackageStatus($status,$agencyId,$packageId)
  {
    $campingDetail=CampingPackages::where("id",$packageId)->first();
    $campingDetail->status=$status;
    if($campingDetail->save())
    {
        \Session::flash('success',"Package status has been updated successfully");
    }
    else
    {
        \Session::flash('error',"Error Occurred. Please try again.");
    }
    return redirect('admin/list-camping-packages/'.$agencyId);
  }

  public function listComboPackages(Request $request)
  {
    $data=$request->all();
    $agency_id=\Request::segment(3);
    $combo_packages = ComboPackages::where("is_deleted",'1')->where('agency_id',$agency_id);
    if ($request->search_text <> '')
    {
      $combo_packages->WhereRaw('(name LIKE "%' . $request->search_text. '%")');
    }
    $combo_packages = $combo_packages->orderBy('id', 'desc')->paginate(10);
    return view('admin.agency.agencyComboPackages', ['combo_packages' => $combo_packages]);
  }

  public function viewComboPackage($agencyId,$packageId)
  {
    $comboDetail=ComboPackages::where("id",$packageId)->first();
    return view('admin.agency.viewComboPackages',['comboDetail'=>$comboDetail]);
  }

  public function deleteComboPackage($agencyId,$packageId)
  {
    $comboDetail=ComboPackages::where("id",$packageId)->first();
    $comboDetail->is_deleted='2';
    if($comboDetail->save())
    {
        \Session::flash('success',"Combo Package has been deleted successfully");
    }
    else
    {
        \Session::flash('error',"Error Occurred. Please try again.");
    }
    return redirect('admin/list-combo-packages/'.$agencyId);
  }

  public function updateComboPackageStatus($status,$agencyId,$packageId)
  {
    $comboDetail=ComboPackages::where("id",$packageId)->first();
    $comboDetail->status=$status;
    if($comboDetail->save())
    {
      \Session::flash('success',"Package status has been updated successfully");
    }
    else
    {
      \Session::flash('error',"Error Occurred. Please try again.");
    }
    return redirect('admin/list-combo-packages/'.$agencyId);
  }

}
