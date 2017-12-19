<?php
namespace App\Http\Controllers\admin;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Database\MySqlConnection;
use App\models\Cms;
use App\models\Admin;
use App\models\Feedback;


class CmsController extends Controller {

    use AuthenticatesUsers;

    /**
     * Function used to fet cms page of pharmacy
     *    
     * @return type
     */  
   public function index($slug)
   {    
   $pageDetail=Cms::where('slug',$slug)->where('type','2')->first();
   return view('admin.cms.index',['slug'=>$slug,'pageDetail'=>$pageDetail]);
   }
   
   public function cmsContactSuport(Request $request){    
   if($request->mobile_number || $request->address){
   $validator=$this->validate($request, [
         'address' => 'required',
         'id' => 'required',
        
      ]);
      $data=$request->all();
      $pageDetail=Admin::first();
      $pageDetail->address=$data['address'];
      $pageDetail->phone_number=$data['mobile_number'];
      
      if($pageDetail->save()){
        \Session::flash('success',\Lang::get('errorMessage.page_update_sccuess'));  
       }
       else{
         \Session::flash('error',\Lang::get('errorMessage.error_occurred'));   
       }
       
   } 
   
   $slug='cms-contact-support';    
   $contact_support=Admin::first();
   return view('admin.cms.contact',['slug'=>$slug,'pageDetail'=>$contact_support]);   
   }
   
   
   public function updateCms(Request $request){
   $validator=$this->validate($request, [
         'text' => 'required',
         'id' => 'required',
        
      ]);
      $data=$request->all();
      $pageDetail=Cms::where('id',$request->id)->where('type','2')->first();
      $pageDetail->content=$data['text'];
      
      if($pageDetail->save())
      {
        \Session::flash('success',\Lang::get('errorMessage.page_update_sccuess'));   
      }  
      else{
         \Session::flash('error',\Lang::get('errorMessage.error_occurred'));
          }
      return redirect('admin/cms-pharmacy/'.$pageDetail['slug']);
     
   }
   
   
   public function updateCmsApp(Request $request){
   $validator=$this->validate($request, [
         'text' => 'required',
         'id' => 'required',
        
      ]);
      $data=$request->all();
      $pageDetail=Cms::where('id',$request->id)->where('type','1')->first();
      $pageDetail->content=$data['text'];
      
      if($pageDetail->save())
      {
        \Session::flash('success',\Lang::get('errorMessage.page_update_sccuess'));   
      }  
      else{
         \Session::flash('error',\Lang::get('errorMessage.error_occurred'));
          }
      return redirect('admin/cms-app/'.$pageDetail['slug']);
     
   }
   
   
   
   
   public function cmsApp($slug){
   $pageDetail=Cms::where('slug',$slug)->where('type','1')->first();
   return view('admin.cms.app',['slug'=>$slug,'pageDetail'=>$pageDetail]);
   }
   
   public function pharmacyFeedback(){
    $feedback=Feedback::orderBy('created_at','desc')->paginate(10);  
    $slug='pharmacy-feedback';
    return view('admin.cms.feedback',['slug'=>$slug,'feedback'=>$feedback]);
   }
    
    

}
