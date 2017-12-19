<?php

namespace App\Http\Controllers\merchant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\CustomHelper;
use App\models\Order;
use App\models\Medicines;
use App\models\UserNotifications;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Mail;

class OrderController extends Controller
{
   use AuthenticatesUsers;
   
   /**
    * Function used to show new orders
    * 
    * @param Request $request
    * @return type
    */
   public function index(Request $request)
   {
      $phar_id=auth()->guard('merchant')->user()->id;
      $order_list=Order::where('phar_id',$phar_id)->where('order_status','1')->orderBy('id', 'desc');
      if($request->id <>''){
         $order_list->where('order_no','LIKE','%'.$request->id.'%');
      }
        
        $order_list=$order_list->paginate(10);
      return view('merchant.order.index',['order_list'=>$order_list])->with('i', ($request->input('page', 1) - 1) * 10);
   }
   
   /**
    * Function used to show the order detail
    * 
    * @param type $orderId
    * @return type
    */
   
   public function orderDetail($orderId)
   {
      $order_detail=Order::findorfail($orderId);
      return view('merchant.order.orderDetail',['order_detail'=>$order_detail]);
   }
   
   /**
    * Function used to accept and reject the order request
    * 
    * @param Request $request
    * 
    */
   
   public function acceptRejectRequest(Request $request)
   {
      $data=$request->all();
      $order_detail=Order::findorfail($data['order_id']);
      $order_detail->order_status=(string)$data['order_status'];
      $order_detail->comment=$data['comment'];
      if($data['order_status'] =='2')
      {
         $order_detail->accepted_on=date('Y-m-d H:i:s');
      }
      else if($data['order_status'] =='3')
      {
         $order_detail->rejected_on=date('Y-m-d H:i:s');
      }
      

      if($order_detail->save())
      {
          
         if($data['order_status'] =='2')
         {
            $notification=UserNotifications::create(array('user_id'=>$order_detail->user_id,'order_id'=>$data['order_id'],'title'=>'Order Accepted','desciption'=>'Your Order #'.$order_detail->order_no.' has been accepted successfully.'));
            if($order_detail->userDetail['is_notification'] =='1')
            {
               CustomHelper::generatePush($order_detail->userDetail['device_type'],$order_detail->userDetail['device_token'],'Order has been accepted successfully.','1',$data['order_id'],$notification->id);
            }
           //Send Mail to user
            $orderDetail['name']=$order_detail->userDetail['first_name'].' '.$order_detail->userDetail['last_name'];
            $orderDetail['order_no']=$order_detail->order_no;
            $orderDetail['email']=$order_detail->userDetail['email'];
            $orderDetail['subject']='Order Accepted';
            CustomHelper::sendMail('emails.orderAccept',$orderDetail);
            
            \Session::flash('success',\Lang::get('errorMessage.req_accept_sccuess'));
         }
         else
         {
            $notification=UserNotifications::create(array('user_id'=>$order_detail->user_id,'order_id'=>$data['order_id'],'title'=>'Order Rejected','desciption'=>'Your Order #'.$order_detail->order_no.' has been rejected.'));
            if($order_detail->userDetail['is_notification'] =='1')
            {
               CustomHelper::generatePush($order_detail->userDetail['device_type'],$order_detail->userDetail['device_token'],'Sorry, Your order has been rejected','2',$data['order_id'],$notification->id);
            }
             //Send Mail to user
            $orderDetail['name']=$order_detail->userDetail['first_name'].' '.$order_detail->userDetail['last_name'];
            $orderDetail['order_no']=$order_detail->order_no;
            $orderDetail['email']=$order_detail->userDetail['email'];
            $orderDetail['pharmacyname']=$order_detail->pharmacyDetails['name'];
            $orderDetail['reason']=$data['comment'];
            $orderDetail['subject']='Order Rejected';
            CustomHelper::sendMail('emails.orderReject',$orderDetail);
            
            if(count($order_detail->orderItems)>0)
            {
               foreach($order_detail->orderItems as $key=>$value)
               {
                  $medDetail=$value->getMedicineName;
                  $medDetail->quantity=$medDetail->quantity+$value->quantity;
                  $medDetail->save();
               }
            }         
            
            \Session::flash('success',\Lang::get('errorMessage.req_reject_sccuess'));
         }         
      }
      else
      {
         \Session::flash('error',\Lang::get('errorMessage.error_occurred'));
      }
      return redirect('merchant/new-order');
   }
   /**
    * Function used to show the order history page
    * 
    * @param Request $request
    * @return type
    */
   
   public function orderHistory(Request $request)
   {
      $phar_id=auth()->guard('merchant')->user()->id;
      $order_list=Order::where('phar_id',$phar_id)->where('order_status','!=','1')->orderBy('id', 'desc');
      if($request->id <>''){
         $order_list->where('order_no','LIKE','%'.$request->id.'%');
      }
      
      if($request->status <>'')
      {
         $order_list->where('order_status',$request->status);
      }
        
      $order_list=$order_list->paginate(10);
      return view('merchant.order.orderHistory',['order_list'=>$order_list])->with('i', ($request->input('page', 1) - 1) * 10);
   }
   
   /**
    * Function used to show the order histroy detail
    * 
    * @param type $orderId
    * @return type
    */
   
   public function orderHistoryDetail($orderId)
   {
      $order_detail=Order::findorfail($orderId);
      return view('merchant.order.orderHistoryDetail',['order_detail'=>$order_detail]);
   }
   
   
   /**
    * Function used to Update the status of the order
    * 
    * @param type $orderId
    * @return type
    */
   
   public function updateStatus(Request $request)
   {
      $data=$request->all();
      $order_detail=Order::findorfail($data['order_id']);
      $order_detail->order_status=$data['status'];
      if($data['status'] =='4')
      {
         
         $order_detail->dispatched_on=date('Y-m-d h:i:s');
         
        
         
      }
      else if($data['status'] =='5')
      {
         
         $order_detail->delivered_on=date('Y-m-d h:i:s');
      }
      
      if($order_detail->save())
      {
         if($data['status'] =='4')
         {
            $notification=UserNotifications::create(array('user_id'=>$order_detail->user_id,'order_id'=>$data['order_id'],'title'=>'Order Dispatched','desciption'=>'Your Order #'.$order_detail->order_no.' has been dispatched.'));
            if($order_detail->userDetail['is_notification'] =='1')
            {
               CustomHelper::generatePush($order_detail->userDetail['device_type'],$order_detail->userDetail['device_token'],'Your order has been dispatched.','3',$data['order_id'],$notification->id);
            }
            
            $orderDetail['name']=$order_detail->userDetail['first_name'].' '.$order_detail->userDetail['last_name'];
            $orderDetail['order_no']=$order_detail->order_no;
            $orderDetail['email']=$order_detail->userDetail['email'];
            $orderDetail['subject']='Order Dispatched';
            CustomHelper::sendMail('emails.orderDispached',$orderDetail);
         }
         else if($data['status'] =='5')
         {
            $notification=UserNotifications::create(array('user_id'=>$order_detail->user_id,'order_id'=>$data['order_id'],'title'=>'Order Delivered','desciption'=>'Your Order #'.$order_detail->order_no.' has been delivered.'));
            if($order_detail->userDetail['is_notification'] =='1')
            {
               CustomHelper::generatePush($order_detail->userDetail['device_type'],$order_detail->userDetail['device_token'],'Your order has been delivered.','4',$data['order_id'],$notification->id);
            }   
            $orderDetail['name']=$order_detail->userDetail['first_name'].' '.$order_detail->userDetail['last_name'];
            $orderDetail['order_no']=$order_detail->order_no;
            $orderDetail['email']=$order_detail->userDetail['email'];
            $orderDetail['subject']='Order Delivered';
            CustomHelper::sendMail('emails.orderDeliverd',$orderDetail);
         }
         
         echo true;
      }
      else
      {
         echo false;
      }
   }
   
   
}
