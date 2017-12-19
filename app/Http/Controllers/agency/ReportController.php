<?php

namespace App\Http\Controllers\merchant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\CustomHelper;
use App\models\Order;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class ReportController extends Controller
{
   use AuthenticatesUsers;
   
   /**
    * 
    * Function used to show earnings of pharmacy
    * @param Request $request
    * @return type
    */
   public function earnings(Request $request)
   {
      $phar_id=auth()->guard('merchant')->user()->id;
      $order_list=Order::where('phar_id',$phar_id)->where('order_status','5');
      if($request->from <>'' && $request->to <>'')
      {
         $order_list->whereDate("created_at",'>=',date('Y-m-d',  strtotime($request->from)));
         $order_list->whereDate("created_at",'<=',date('Y-m-d',  strtotime($request->to)));
      }
        
      $order_list=$order_list->paginate(10);
      return view('merchant.reports.earnings',['order_list'=>$order_list])->with('i', ($request->input('page', 1) - 1) * 10);
   }
   
   /**
    * Function used to show all orders of pharmacy
    * 
    * @param Request $request
    * @return type
    */
   public function totalOrders(Request $request)
   {
      $phar_id=auth()->guard('merchant')->user()->id;
      $order_list=Order::where('phar_id',$phar_id);
      if($request->from <>'' && $request->to <>'')
      {
         $order_list->whereDate("created_at",'>=',date('Y-m-d',  strtotime($request->from)));
         $order_list->whereDate("created_at",'<=',date('Y-m-d',  strtotime($request->to)));
      }
      
      if($request->status <>'')
      {
         $order_list->where('order_status',$request->status);
      }
        
      $order_list=$order_list->paginate(10);
      
      return view('merchant.reports.totalOrders',['order_list'=>$order_list])->with('i', ($request->input('page', 1) - 1) * 10);
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
      return view('merchant.reports.orderDetail',['order_detail'=>$order_detail]);
   }
   
   /**
    * Function used to show the order detail
    * 
    * @param type $orderId
    * @return type
    */
   
   public function getOrderInfo(Request $request)
   {
      $data=$request->all();
      $order_detail=Order::findorfail($data['order_id']);
      $result=array();
      $trHTML = '<tr><th>Sr. No.</th><th>Medicine Name</th><th>Quantity</th><th>Price ('.config('services.currency').')</th></tr>';
      $sub_total=0;
      if(count($order_detail->orderItems)>0)
      {
         foreach($order_detail->orderItems as $key=>$order_items)
         {
            $sub_total=$sub_total+($order_items->quantity*$order_items->price);
            $trHTML .= '<tr><td>'.($key+1).'</td>'. '<td>'.$order_items->getMedicineName->name.'</td><td>'.$order_items->quantity.'</td><td>'.$order_items->price.'</td></tr>';
         }
         $trHTML .= '<tr><td colspan="2"></td><td>Sub Total</td><td>'.number_format($sub_total,2).'</td></tr>';
         $trHTML .= '<tr><td colspan="2"></td><td>Delivery Charges</td><td>'.number_format($order_detail->delivery_charges,2).'</td></tr>';
         if(count($order_detail->orderTaxes) >0)
         {
            foreach($order_detail->orderTaxes as $key=>$order_taxes)
            {
               $sub_total=$sub_total+$order_taxes->calculated_amount;
               $trHTML .= '<tr><td colspan="2"></td><td>'.$order_taxes->label.'</td><td>'.number_format($order_taxes->calculated_amount,2).'</td></tr>';
            }
         }
         $trHTML .= '<tr><td colspan="2"></td><td>TOtal</td><td>'.number_format(($sub_total+$order_detail->delivery_charges),2).'</td></tr>';
      }
      else
      {
         $trHTML .='<tr><td colspan="4"><center>Sorry No Result Found</center></td></tr>';
      }
      $result['trHTML']=$trHTML;
      return response()->json($result);
   }
}
