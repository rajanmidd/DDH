<?php

namespace App\Http\Controllers\merchant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Medicines;
use App\models\QuantityUnits;
use App\Helpers\CustomHelper;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class InventoryController extends Controller
{
   use AuthenticatesUsers;

   /**
    * Function used to get all the medicine lists
    *    
    * @return type
    */
   public function index(Request $request)
   {
      $phar_id=auth()->guard('merchant')->user()->id;
      $inventory_list=Medicines::where('phar_id',$phar_id)->where('is_deleted','0');
      
      if($request->name <>'')
      {
         $inventory_list->where('name','LIKE','%'.$request->name.'%');
      }
      
      if($request->prescription <>'')
      {
         $inventory_list->where('prescription','LIKE','%'.$request->prescription.'%');
      }      
        
      $inventory_list=$inventory_list->orderBy('name','asc')->paginate(10);

      return view('merchant.inventory.index',['inventory_list'=>$inventory_list])->with('i', ($request->input('page', 1) - 1) * 10);
   }   
   
   /**
    * Function used to show medicine listing page
    * 
    * @return type
    */
   public function addInventory()
   {
      $units=CustomHelper::getQuantityUnits();
      return view('merchant.inventory.addInventory',compact('units'));
   }
   
   /**
    * Function used to add new medicine
    * 
    * @param Request $request
    */
   
   public function store(Request $request)
   {
      $validator=$this->validate($request, [
         'name' => 'required|max:100',
         'description' => 'required',
         'quantity' => 'required|integer',
         'price' => 'required|regex:/^\d*(\.\d{2})?$/',
         'quantity_unit' => 'required',
         'prescription' => 'required',
         'med_image' => 'required|mimes:jpeg,gif,png,jpg',
      ]);
      $data=$request->all();
      $phar_id=auth()->guard('merchant')->user()->id;
      $med_image=$request->file('med_image');
      $image_url=CustomHelper::saveImageOnCloudanary($med_image);
      $data['med_image']=$image_url;
      $data['unit_type_id']=$data['quantity_unit'];
      $data['phar_id']=$phar_id;
      $data['prescription']=(string) $data['prescription'];      

      Medicines::create($data);
      \Session::flash('success',\Lang::get('errorMessage.med_add_sccuess'));
      return redirect('merchant/list-inventory');
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
      $phar_id=auth()->guard('merchant')->user()->id;
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
            \Session::flash('success',\Lang::get('errorMessage.med_add_sccuess'));
            return redirect('merchant/list-inventory');
         }
         else
         {        
            \Session::flash('error',\Lang::get('errorMessage.med_upload_error'));
            return redirect('merchant/list-inventory');
         }         
      }
   }
   
   /**
    * Function used to soft delete the medicine 
    * 
    * 
    * @param Request $request
    */
   
   public function delete($id)
   {
      $medicineDetail=Medicines::where('id',$id)->first();
      $medicineDetail->is_deleted='1';
      if($medicineDetail->save())
      {
         \Session::flash('success',\Lang::get('errorMessage.med_delete_sccuess'));
      }
      else
      {
         \Session::flash('error',\Lang::get('errorMessage.error_occurred'));        
      }
      return redirect('merchant/list-inventory');
   }
   
   /**
    * Function used to get the inventpory detail and show edit form
    * 
    * @param type $id
    */
   
   public function edit($id)
   {
      $medicineDetail=Medicines::where('id',$id)->first();
      $units=CustomHelper::getQuantityUnits();
      return view('merchant.inventory.editInventory',compact('medicineDetail','units'));
   }
   
   /**
    * Function used to update the inventory
    * 
    * @param Request $request
    */
   
   public function update(Request $request)
   {
       $validator=$this->validate($request, [
         'name' => 'required',
         'description' => 'required',
         'quantity' => 'required|integer',
         'quantity_unit' => 'required',
         'price' => 'required|regex:/^\d*(\.\d{2})?$/',
         'prescription' => 'required',
         'med_image' => 'mimes:jpeg,gif,png,jpg',
      ]);
      $data=$request->all();
      $medicineDetail=Medicines::where('id',$data['id'])->first();
      $medicineDetail->name=$data['name'];
      $medicineDetail->description=$data['description'];
      $medicineDetail->quantity=$data['quantity'];
      $medicineDetail->unit_type_id=$data['quantity_unit'];
      $medicineDetail->price=$data['price'];
      $medicineDetail->prescription=$data['prescription'];
      
      if($request->file('med_image'))
      {
         $med_image=$request->file('med_image');
         $image_url=CustomHelper::saveImageOnCloudanary($med_image);
         $medicineDetail->med_image=$image_url;
      }
      
      if($medicineDetail->save())
      {
         \Session::flash('success',\Lang::get('errorMessage.med_update_sccuess'));
      }
      else
      {
         \Session::flash('error',\Lang::get('errorMessage.error_occurred'));
      }
      return redirect('merchant/list-inventory');

   }
}
