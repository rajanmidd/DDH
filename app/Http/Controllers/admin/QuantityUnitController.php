<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\models\QuantityUnits;
use Illuminate\Support\Facades\Validator;

class QuantityUnitController extends Controller
{
   use AuthenticatesUsers;
   
    /**
    * Function used to get all the Pharmacy lists
    *    
    * @return type
    */
   public function index(Request $request)
   {
   
      $quanty_unit_list=QuantityUnits::where('is_deleted','0');
      $quanty_unit_list=$quanty_unit_list->paginate(10);
      return view('admin.quantityUnit.list',['quanty_unit_list'=>$quanty_unit_list]); 
   }
   
   
   
    /**
    * Function used to update pharmacy delete status
    *    
    * @return type
    */
   
   public function deleteUnitType(Request $request){
      $Detail=  QuantityUnits::where('id',$request->id)->first();
      $Detail->is_deleted='1';
      if($Detail->save())
      {
         \Session::flash('success',\Lang::get('quantityUnit.delete_sccuess'));
      }
      else
      {
         \Session::flash('error',\Lang::get('quantityUnit.delete_error'));        
      }
      return redirect('admin/quantiy-unit-list');
     
   }
   
   
    /**
    * Function used to block Pharmacy
    *    
    * @return type
    */
   
   public function blockUnitType(Request $request){
      $Detail=QuantityUnits::where('id',$request->id)->first();
      $Detail->status='1';
      if($Detail->save())
      {
         \Session::flash('success',\Lang::get('quantityUnit.block_sccuess'));
      }
      else
      {
         \Session::flash('error',\Lang::get('quantityUnit.block_error'));        
      }
     return redirect('admin/quantiy-unit-list');
     
   }
   
     /**
    * Function used to unblock Pharmacy
    *    
    * @return type
    */
   
   public function unBlockUnitType(Request $request){
      $Detail=QuantityUnits::where('id',$request->id)->first();
      $Detail->status='0';
      if($Detail->save())
      {
         \Session::flash('success',\Lang::get('quantityUnit.unblock_sccuess'));
      }
      else
      {
         \Session::flash('error',\Lang::get('quantityUnit.unblock_error'));        
      }
         return redirect('admin/quantiy-unit-list');
     
   }
   
   
 
     /**
    * Function used to check pharmacy already exist
    *    
    * @return type
    */
   
   
    public function checkPharmacyExists(Request $request)
   {
     
     
      if(!empty($request->mail))
      {
         $checkPharmacyEmail=Pharmacy::whereEmail($request->mail)->first();
       
         if(!empty($checkPharmacyEmail))
         {
            echo 1;
         }
         else
         {
            echo 0;
         }
      }
      else
      {
         echo 0;
      }
   }
   
   
        
     public function addQuantityUnit(Request $request){
      if($request->id){   
      $Detail=QuantityUnits::where('id',$request->id)->first();
      return view('admin.quantityUnit.edit',['Detail'=>$Detail]);
      }
      else{
       return view('admin.quantityUnit.add');
      }
      
     }

     public function storeUnitType(Request $request)
   {
      $validator=$this->validate($request, [
         'name' => 'required',
         'status' => 'required',
      ]);
    
      $data=$request->all(); 
      if($request->id){
      $Detail=QuantityUnits::where('id',$request->id)->first();
      $Detail->name=$request->name;
      $Detail->status=$request->status;
      if($Detail->save())
      {
         \Session::flash('success',\Lang::get('quantityUnit.item_updated_successfully'));
      }
      else
      {
         \Session::flash('error',\Lang::get('quantityUnit.udate_error'));        
      }    
      }
      else{
      $data['name']=$data['name'];
      $data['status']=$data['status'];     
      QuantityUnits::create($data);
      \Session::flash('success',\Lang::get('quantityUnit.item_added_successfully'));
        
          
      }
      
      return redirect("admin/quantiy-unit-list");  
     
   }
   
   
   
 
   
}
