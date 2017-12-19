<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\CustomHelper;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\models\Pharmacy;
use App\models\PharmacyDocuments;
use App\models\PharmacyTimings;
use App\models\Medicines;
use App\models\Order;
use App\models\OrderItem;
use App\models\PharmacyTax;
use App\models\PharmacyDiscount;
use Illuminate\Support\Facades\Validator;
use Mail;


class PharmacyController extends Controller
{
   use AuthenticatesUsers;
   
    /**
    * Function used to get all the Pharmacy lists
    *    
    * @return type
    */
   public function index(Request $request)
   {
   
      $pharmacy_list=Pharmacy::where('is_deleted','0');
      
      if($request->status <>'' && $request->status==0)
      {
         $pharmacy_list->where('status',$request->status);
      }  
      
      if($request->status <>'' && $request->status==1)
      {
         $pharmacy_list->where('status',$request->status);
      }  
      
      if($request->status <>'' && $request->status==2)
      {
         $pharmacy_list->where('status',$request->status);
      }
      
      if($request->search_text <>'')
      {
         $pharmacy_list->WhereRaw('(name LIKE "%'. $request->search_text.'%" or email LIKE "%'.$request->search_text.'%" or mobile LIKE "%'.$request->search_text.'%")');
      }
      
      $pharmacy_list=$pharmacy_list->orderBy('id','desc')->paginate(10);
      return view('admin.pharmacy.index',['pharmacy_list'=>$pharmacy_list]); 
   }
   
   
   
    /**
    * Function used to update pharmacy delete status
    *    
    * @return type
    */
   
   public function deletePharmacy(Request $request){
      $PharmacyDetail=Pharmacy::where('id',$request->id)->first();
      $PharmacyDetail->is_deleted='1';
      if($PharmacyDetail->save())
      {
         \Session::flash('success',\Lang::get('pharmacy.pharmacy_delete_sccuess'));
      }
      else
      {
         \Session::flash('error',\Lang::get('pharmacy.pharmacy_delete_error'));        
      }
      return redirect('admin/list-pharmacy');
     
   }
   
   
    /**
    * Function used to block Pharmacy
    *    
    * @return type
    */
   
   public function blockPharmacy(Request $request){
      $pharmacyDetail=Pharmacy::where('id',$request->id)->first();
      $pharmacyDetail->is_block='1';
      if($pharmacyDetail->save())
      {
         \Session::flash('success',\Lang::get('pharmacy.pharmacy_block_sccuess'));
      }
      else
      {
         \Session::flash('error',\Lang::get('pharmacy.pharmacy_block_error'));        
      }
      return redirect('admin/list-pharmacy');
     
   }
   
     /**
    * Function used to unblock Pharmacy
    *    
    * @return type
    */
   
   public function unBlockPharmacy(Request $request){
      $pharmacyDetail=Pharmacy::where('id',$request->id)->first();
      $pharmacyDetail->is_block='0';
      if($pharmacyDetail->save())
      {
         \Session::flash('success',\Lang::get('pharmacy.pharmacy_unblock_sccuess'));
      }
      else
      {
         \Session::flash('error',\Lang::get('pharmacy.pharmacy_unblock_error'));        
      }
      return redirect('admin/list-pharmacy');
     
   }
   
   
    /**
    * Function used to get pharmacy add form
    *    
    * @return type
    */
   public function addPharmacy(Request $request)
   {
       
      $days=CustomHelper::getDays();
      return view('admin.pharmacy.add',["days"=>$days]);  
   }
   
     /**
    * Function used to check pharmacy already exist
    *    
    * @return type
    */
   
   
    public function checkPharmacyExists(Request $request)
   {
     
     
      if(!empty($request->email))
      {
         $checkPharmacyEmail=Pharmacy::whereEmail($request->email)->first();
       
         if(!empty($checkPharmacyEmail))
         {
            echo 'false';
         }
         else
         {
            echo 'true';
         }
      }
      else
      {
         echo 'false';
      }
   }
   
   
      /**
    * Function used to create new Pharmacy
    *    
    * @return type
    */
   
    public function store(Request $request)
   { 
        $params = $request->all();
        $rules = array(
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'description' => 'required',
            'password'=>'required',
            'address'=>'required',
            'city'=>'required',
        );
        $this->validate($request,$rules);
        
            //save to database
          
      $verification_code=md5(str_random(64) . time()*64);
      $data=$request->all();
      $data['temp_access_token']=$verification_code;
      $data['password']= bcrypt($data['password']);
      $pharmacy=Pharmacy::create($data); 
     
      if(count($data['day']) >0)
      {
         $allTimings=array();
         foreach($data['day'] as $key=>$value)
         {
            $pharTimings=array();
            $pharTimings['phar_id']=$pharmacy->id;
            $pharTimings['day']=$value;
            $pharTimings['open_time']=$data['open_time'][$key];
            $pharTimings['close_time']=$data['close_time'][$key];
            $allTimings[$key]=$pharTimings;
         }
         PharmacyTimings::insert($allTimings);
      }
      
     
       $pharmacy_image = $request->file('pharmacy_image');
       $licence_image = $request->file('licence_image'); 
      if(isset($pharmacy_image)){
        $pharmacy_iamge=CustomHelper::saveImageOnCloudanary($pharmacy_image);
        $pharImage['phar_image']=$pharmacy_iamge;
        $pharImage['phar_id']= $pharmacy->id;
        $pharImage['license_image']= ''; 
        $pharmacyImage=PharmacyDocuments::create($pharImage); 
      }
      
      if(isset($licence_image)){
        $licence_image=CustomHelper::saveImageOnCloudanary($licence_image);
        $LicenceDetail=PharmacyDocuments::where('phar_id',$pharmacy->id)->first();
        $LicenceDetail->license_image=$licence_image;
        $licence= $LicenceDetail->save(); 
      }

      //Send Mail to pharmacy
      $mail=Mail::send('emails.welcome', $data, function($message) use ($data)
      {
         $message->from('no-reply@site.com', "Med-Me");
         $message->subject("Login Credential From Med-Me Admin");
         $message->to($data['email']);
         
      });
      
      if( count(Mail::failures()) > 0 )
      {
         return back()->withInput();
      }
      else
      {
         return redirect('admin/list-pharmacy');
      } 
        
            
            
            
            
            
        }
        
   /**
   * Function used to get Pharmacy profile details
   *    
   * @return type
   */
   public function pharmacyProfile(Request $request)
   {
      $pharmacyDetail=Pharmacy::with('pharTimings','pharDocuments')->where('id',$request->id)->first();
      $timing=$pharmacyDetail->pharTimings;
      $image=$pharmacyDetail->pharDocuments;
      $days=CustomHelper::getDays();
      $status1= "active";
      $status2= "";
      $status3= "";
      $status4= "";
      return view('admin.pharmacy.profile',["days"=>$days,"status1"=>$status1,"status2"=>$status2,"status3"=>$status3,"status4"=>$status4,"pharmacyDetail"=>$pharmacyDetail,'timing'=>$timing,'image'=>$image]);      
   }       
        
   /**
   * Function used to get Medicines 
   *    
   * @return type
   */
        
   public function getMedicines(Request $request)
   {
      $pharmacy_list=  Medicines::where('is_deleted','0')->where('phar_id', '=',$request->id);
      $pharmacy_list=$pharmacy_list->paginate(10);
      $status1= "";
      $status2= "active";
      $status3= "";
       $status4= "";
      return view('admin.pharmacy.medicine',["pharmacy_list"=>$pharmacy_list,"status1"=>$status1,"status2"=>$status2,"status3"=>$status3,"status4"=>$status4]);      
   }
   
   /**
   * Function used to set pharmacy commission 
   *    
   * @return type
   */
        
   public function setCommission(Request $request)
   {
      $pharmacyDetail=Pharmacy::where('id',$request->id)->first();
      $phar_discount=PharmacyDiscount::where('phar_id',$request->id)->first();
      $pharmacyTax=PharmacyTax::where('phar_id',$request->id)->get();
      $status1= "";
      $status2= "";
      $status3= "";
      $status4= "active";
      return view('admin.pharmacy.setCommission',["phar_discount"=>$phar_discount,"pharmacyDetail"=>$pharmacyDetail,"pharmacyTax"=>$pharmacyTax,"status1"=>$status1,"status2"=>$status2,"status3"=>$status3,"status4"=>$status4]);      
   }
      
    /**
    * Function used to upload pharmacy and licence image 
    *    
    * @return type
    */    
     public function uploadPharmacyImage(Request $request) {
      $image = $request->file('IDProof');
      $docType=$request->uploadType;
      $check_image=PharmacyDocuments::where('phar_id',$request->ID)->first();
  
       if(isset($check_image)){
        $image=CustomHelper::saveImageOnCloudanary($image);
        $PharmacyDetail=PharmacyDocuments::where('phar_id',$request->ID)->first();
        $PharmacyDetail->$docType=$image;
       if($PharmacyDetail->save())
       {
         \Session::flash('success',\Lang::get('pharmacy.image_uploaded_successfully'));
       }
       else
       {
         \Session::flash('error',\Lang::get('pharmacy.something_went_wrong'));        
       }
       return redirect('admin/pharmacy-profile?id='.$request->ID);
       }
       
       else{
        $image=CustomHelper::saveImageOnCloudanary($image);
        $pharDetails[$docType]=$image;
        $remaining_field=$docType=='license_image'?'phar_image':'licence_image';
        $pharImage[$remaining_field]= ''; 
        $pharDetails['phar_id']= $request->ID;
       if(PharmacyDocuments::create($pharDetails))
       {
         \Session::flash('success',\Lang::get('pharmacy.image_uploaded_successfully'));
       }
       else
       {
         \Session::flash('error',\Lang::get('pharmacy.something_went_wrong'));        
       }
       return redirect('admin/pharmacy-profile?id='.$request->ID);   
       }

    }
      
      
      /**
    * Function used to delete licence image or pharmacy image 
    *    
    * @return type
    */   
     public function deleteImage(Request $request) {
        if($request->type && $request->id){
        $image='';
        $type=$request->type;
        $PharmacyDetail=PharmacyDocuments::where('phar_id',$request->id)->first();
        $PharmacyDetail->$type=$image;
       if($PharmacyDetail->save())
       {
         \Session::flash('success',\Lang::get('pharmacy.image_deleted_successfully'));
       }
       else
       {
         \Session::flash('error',\Lang::get('pharmacy.something_went_wrong'));        
       }
       
       }
       else{
         \Session::flash('error',\Lang::get('pharmacy.something_went_wrong'));
         return redirect('admin/pharmacy-profile?id='.$request->id);
       }
       return redirect('admin/pharmacy-profile?id='.$request->id);
     }
  
    /**
    * Function used to delete licence image or pharmacy image 
    *    
    * @return type
    */ 
     public function pharmacyAcceptReject(Request $request) {
        $pharmact_id =$request->pharmacy_id_field;
        $reason = $request->reason;
        $status = $request->pharmacy_status;
        if($status==1){
        if($pharmact_id && $reason && $status){
        $PharmacyDetail=Pharmacy::where('id',$pharmact_id)->first();
        
        $PharmacyDetail->status=$status;
        $PharmacyDetail->rejection_message=$reason;
        
       if($PharmacyDetail->save())
       {
         \Session::flash('success',\Lang::get('pharmacy.accepted_successfully'));
       }
       else
       {
         \Session::flash('error',\Lang::get('pharmacy.something_went_wrong'));        
       }
       
       }
       else{
         \Session::flash('error',\Lang::get('pharmacy.something_went_wrong'));
         return redirect('admin/pharmacy-profile?id='.$request->pharmacy_id_field);
       }
       return redirect('admin/pharmacy-profile?id='.$request->pharmacy_id_field);
     } 
     
     
     
    if($status==2){
        if($pharmact_id && $reason && $status){
        $PharmacyDetail=Pharmacy::where('id',$pharmact_id)->first();
        
        $PharmacyDetail->status=$status;
        $PharmacyDetail->rejection_message=$reason;
        
          //Send Mail to pharmacy
            $Detail['email']=$PharmacyDetail->email;
            $Detail['subject']='Pharmacy Rejection';
            CustomHelper::sendMail('emails.pharmacyRejection',$Detail);
        
       if($PharmacyDetail->save())
       {
         \Session::flash('success',\Lang::get('pharmacy.rejected_successfully'));
       }
       else
       {
         \Session::flash('error',\Lang::get('pharmacy.something_went_wrong'));        
       }
       
       }
       else{
         \Session::flash('error',\Lang::get('pharmacy.something_went_wrong'));
         return redirect('admin/pharmacy-profile?id='.$request->pharmacy_id_field);
       }
       return redirect('admin/pharmacy-profile?id='.$request->pharmacy_id_field);
     } 
     
     
     
     
        }
       
        
     public function addMedicine(){
      $units=CustomHelper::getQuantityUnits();
      return view('admin.medicine.add',compact('units'));
     }

     public function storeMedicine(Request $request)
   {
         
      $validator=$this->validate($request, [
         'name' => 'required',
         'description' => 'required',
         'quantity' => 'required|integer',
         'price' => 'required|regex:/^\d*(\.\d{2})?$/',
         'quantity_unit' => 'required',
         'prescription' => 'required',
         'med_image' => 'required|mimes:jpeg,gif,png,jpg',
      ]);
      $data=$request->all();
      $phar_id=$request->pharmacy_id;
      $med_image=$request->file('med_image');
      $image=CustomHelper::saveImageOnCloudanary($med_image);
      $data['med_image']=$image;
      $data['unit_type_id']=$data['quantity_unit'];
      $data['phar_id']=$phar_id;
      $data['prescription']=(string) $data['prescription'];      

      Medicines::create($data);
      \Session::flash('success',\Lang::get('pharmacy.medicine_added_successfully'));
      return redirect('admin/medicines?id='.$phar_id);
   }
   
    /**
    * Function used to add new medicine by using excel sheet
    * 
    * 
    * @param Request $request
    */
   
   public function importExcel(Request $request)
   {
      $file=$request->file('excel_med_uplad');
      $destinationPath =  public_path ().'/uploads/';
      $imageFileName = time().'.' .$file->getClientOriginalExtension();
      $file->move($destinationPath,$imageFileName);
      $phar_id=$request->pharmacy_id;
      if(($handle = fopen($destinationPath.$imageFileName, 'r' )) !== FALSE) 
      {
         $i=0;
         $k=1;
         $allMed=array();
         while(($data = fgetcsv($handle,1000,',')) !== FALSE ) 
         {
            if($i == 0)
            { 
               if($data['0'] !="Name" || $data['1'] !="Description" || $data['2'] !="Quantity" || $data['3'] !="Price" || $data['4'] !="Prescription" || $data['5'] !="Med Image")
               {
                  $k=0;
                  break;
               }
               $i++; 
               continue; 
            }
            
            $medData=array();
            $medData['phar_id']=$phar_id;
            $medData['name']=$data['0'];
            $medData['description']=$data['1'];
            $medData['quantity']=$data['2'];
            $medData['price']=$data['3'];
            $medData['prescription']=(string) $data['4'];
            $medData['med_image']=$data['5'];
            $medData['unit_type_id']="1";
            $allMed[$i]=$medData;
            $i++;           
         }
         fclose($handle);
         if($k ==1)
         {
         Medicines::insert($allMed); 
        
         \Session::flash('success',\Lang::get('pharmacy.med_add_sccuess'));
         return redirect('admin/medicines?id='.$phar_id);
         }
         else{
           \Session::flash('error',\Lang::get('errorMessage.med_upload_error'));
            return redirect('admin/medicines?id='.$phar_id);
         }
      }
   } 
   
   
   
    /**
    * Function used to get particular pharmacy order list
    *    
    * @return type
    */
   public function getPharmacyOrders(Request $request)
   {
       
      $status1= "";
      $status2= "";
      $status3= "active"; 
      $status4= ""; 
      $order_list=Order::where('phar_id',$request->id);
      
      if($request->search_text <>''){
      $order_list->where('order_no','LIKE','%'.$request->search_text.'%');
      }
     if($request->status <>''){
      $order_list->where('order_status',$request->status);
      } 
     $order_list=$order_list->orderBy('id','desc')->paginate(10);
         return view('admin.pharmacy.order',['order_list'=>$order_list,"status1"=>$status1,"status2"=>$status2,"status3"=>$status3,"status4"=>$status4]);      
     
   }
   
   
   
   //Rajan
   
   /**
    * Function used to Update Pharmacy
    *    
    * @return type
    */
   
   public function updatePharmacy(Request $request)
   { 
      $params = $request->all();
      $rules = array(
         'name' => 'required',
         'mobile' => 'required',
         'description' => 'required',
         'address'=>'required',
         'city'=>'required',
         'latitude'=>'required',
         'longitude'=>'required',
      );
      $this->validate($request,$rules);
      
      $data=$request->all();
      
      $phar_id=$data['phar_id'];
      $profileDetail=Pharmacy::where('id',$phar_id)->first();
      $profileDetail->name=$data['name'];
      $profileDetail->description=$data['description'];
      $profileDetail->mobile=$data['mobile'];
      $profileDetail->city=$data['city'];
      $profileDetail->address=$data['address'];
      $profileDetail->latitude=$data['latitude'];
      $profileDetail->longitude=$data['longitude'];
            
      if($profileDetail->save())
      {
         PharmacyTimings::where('phar_id',$phar_id)->delete();
         $allTimings=array();
         foreach($data['day'] as $key=>$value)
         {
            $pharTimings=array();
            $pharTimings['phar_id']=$phar_id;
            $pharTimings['day']=$value;
            $pharTimings['open_time']=$data['open_time'][$key];
            $pharTimings['close_time']=$data['close_time'][$key];
            $allTimings[$key]=$pharTimings;
         }
         PharmacyTimings::insert($allTimings);
         \Session::flash('success',\Lang::get('errorMessage.profile_update_sccuess'));
      }
      else
      {
         \Session::flash('error',\Lang::get('errorMessage.error_occurred'));
      }
      
     return redirect('admin/pharmacy-profile?id='.$phar_id);
   }
   
   /**
    *Function used to add tax for a pharmacy
    *  
    * @param Request $request
    */
   
   public function addTax(Request $request)
   {
      $data = $request->all();
      $phar_id=$data['phar_id'];
      
      $phar_discount=PharmacyDiscount::where('phar_id',$phar_id)->first();
      if($phar_discount)
      {
         $phar_discount->discount=($data['admin_commision'])?$data['admin_commision']:'0';
         $phar_discount->save();
      }
      else
      {
         $pharDiscount=array();
         $pharDiscount['phar_id']=$phar_id;
         $pharDiscount['discount']=$phar_id;
         PharmacyDiscount::create($pharDiscount);
      }
      PharmacyTax::where('phar_id',$phar_id)->delete();
      $tax_array=array();
      $i=0;
      
//      if(isset($data['admin_commision']) && !empty($data['admin_commision']))
//      {
//         $tax_array[$i]['phar_id']=$phar_id;
//         $tax_array[$i]['label']='Commission';
//         $tax_array[$i]['amount']=$data['admin_commision'];
//         $tax_array[$i]['type']='1';
//         $i++;
//      }
      
      if(isset($data['delivery_charges']) && !empty($data['delivery_charges']))
      {
         $tax_array[$i]['phar_id']=$phar_id;
         $tax_array[$i]['label']='Delivery';
         $tax_array[$i]['amount']=$data['delivery_charges'];
         $tax_array[$i]['type']='2';
         $i++;
      }
      
      if(isset($data['label']) && count($data['label'])>0)
      {
         foreach($data['label'] as $key=>$value)
         {
            $taxArray=array();
            $taxArray['phar_id']=$phar_id;
            $taxArray['label']=$value;
            $taxArray['amount']=$data['value'][$key];
            $taxArray['type']=$data['type'][$key];
            $tax_array[$i]=$taxArray;
            $i++;
         }
      }

      PharmacyTax::insert($tax_array);
      
      //return redirect('admin/list-pharmacy'); 
      return redirect('admin/set-comission?id='.$phar_id);
   }

   
   
}
