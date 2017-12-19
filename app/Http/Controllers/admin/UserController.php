<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\models\User;

class UserController extends Controller
{
   use AuthenticatesUsers;
   
    /**
    * Function used to get all the user lists
    *    
    * @return type
    */
   public function index(Request $request)
   {
   
      $user_list=User::where('is_deleted','0');
     
      if($request->status <>'' && $request->status==0)
      {
         $user_list->where('status',$request->status);
      } 
      
      if($request->status <>'' && $request->status==1)
      {
         $user_list->where('status',$request->status);
      } 
      if($request->status <>'' && $request->status==2)
      {
         $user_list->where('is_block','1');
      }
      
      if($request->status <>'' && $request->status==3)
      {
         $user_list->where('is_block','0');
      }
      
      if($request->search_text <>'')
      {
         $user_list->WhereRaw('(first_name LIKE "%'. $request->search_text.'%" or last_name LIKE "%'.$request->search_text.'%" or email LIKE "%'.$request->search_text.'%" or mobile LIKE "%'.$request->search_text.'%")');
      }
      $user_list=$user_list->paginate(10);
      
      return view('admin.user.index',['user_list'=>$user_list]); 
   }
   
   
   
    /**
    * Function used to update user delete status
    *    
    * @return type
    */
   
   public function deleteUser(Request $request){
      $userDetail=User::where('id',$request->id)->first();
      $userDetail->is_deleted='1';
      if($userDetail->save())
      {
         \Session::flash('success',\Lang::get('user.user_delete_sccuess'));
      }
      else
      {
         \Session::flash('error',\Lang::get('user.user_delete_error'));        
      }
      return redirect('admin/list-user');
     
   }
   
   
    /**
    * Function used to block user
    *    
    * @return type
    */
   
   public function blockUser(Request $request){
      $userDetail=User::where('id',$request->id)->first();
      $userDetail->is_block='1';
      if($userDetail->save())
      {
         \Session::flash('success',\Lang::get('user.user_block_sccuess'));
      }
      else
      {
         \Session::flash('error',\Lang::get('user.user_block_error'));        
      }
      return redirect('admin/list-user');
     
   }
   
     /**
    * Function used to unblock user
    *    
    * @return type
    */
   
   public function unBlockUser(Request $request){
      $userDetail=User::where('id',$request->id)->first();
      $userDetail->is_block='0';
      if($userDetail->save())
      {
         \Session::flash('success',\Lang::get('user.user_unblock_sccuess'));
      }
      else
      {
         \Session::flash('error',\Lang::get('user.user_unblock_error'));        
      }
      return redirect('admin/list-user');
     
   }
   
  
   
   
   
   
}
