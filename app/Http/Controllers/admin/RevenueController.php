<?php

namespace App\Http\Controllers\admin;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\models\User;
use App\models\Order;
use App\models\OrderItem;
use App\models\Pharmacy;
use App\models\PharmacyDocuments;
use App\models\PharmacyTimings;
use Illuminate\Database\MySqlConnection;

class RevenueController
        extends Controller {

    use AuthenticatesUsers;

    /**
     * Function used to get total revenue of pharmacy and admin
     *    
     * @return type
     */
    public function getEarnedRevenue(Request $request) {
         if($request->from <>'' && $request->to <>'')
        {
             
        $list = Order::select(DB::raw('(select sum(total_amount) from tbl_orders where DATE(tbl_orders.created_at) >="'.date('Y-m-d',  strtotime($request->from)).'" and DATE(tbl_orders.created_at) <="'.date('Y-m-d',  strtotime($request->to)).'") as total_phar_order_amount'),DB::raw('(select sum(admin_commision) from tbl_orders where DATE(tbl_orders.created_at) >="'.date('Y-m-d',  strtotime($request->from)).'" and DATE(tbl_orders.created_at) <="'.date('Y-m-d',  strtotime($request->to)).'") as total_admin_amount'),'pharmacy.name','orders.phar_id')
              ->join('pharmacy','pharmacy.id','=','orders.phar_id')->where('orders.order_status','5');
        }
        else{
         $list = Order::select(DB::raw('(select sum(total_amount) from tbl_orders) as total_phar_order_amount'),DB::raw('(select sum(admin_commision) from tbl_orders) as total_admin_amount'),'pharmacy.name','orders.phar_id')
              ->join('pharmacy','pharmacy.id','=','orders.phar_id')->where('orders.order_status','5');   
        }


       if($request->from <>'' && $request->to <>'')
      {
         $list->whereDate("orders.created_at",'>=',date('Y-m-d',  strtotime($request->from)));
         $list->whereDate("orders.created_at",'<=',date('Y-m-d',  strtotime($request->to)));
      }
        $list->groupBy("orders.phar_id");
        //echo $list->toSql(); die;
        $list = $list->paginate(10);
        
        return view('admin.revenue.index',['order_list' => $list]);
    }
    
    
     /**
     * Function used to view order details by particular pharmacy
     *    
     * @return type
     */
    public function viewOrder(Request $request){
    $pharmacy_details = Pharmacy::where('id',$request->id)->first();
    $order_list = Order::select('orders.id',
                        'orders.order_no',
                        'orders.total_amount',
                        'orders.payment_type',
                        'orders.order_status',
                        'orders.delivery_charges',
                        'orders.created_at',
                        'orders.admin_commision',
                        'users.first_name',
                        'users.last_name',
                        'pharmacy.name')
                ->join('users',
                        'users.id',
                        '=',
                        'orders.user_id')
                ->join('pharmacy',
                'pharmacy.id',
                '=',
                'orders.phar_id');

        if ($request->search_text <> '') {
            $order_list->where('orders.order_no',
                            'LIKE',
                            '%' . $request->search_text . '%')
                    ->orwhere('pharmacy.name',
                            'LIKE',
                            '%' . $request->search_text . '%');
        }
        
         if($request->from <>'' && $request->to <>'')
      {
         $order_list->whereDate("orders.created_at",'>=',date('Y-m-d',  strtotime($request->from)));
         $order_list->whereDate("orders.created_at",'<=',date('Y-m-d',  strtotime($request->to)));
      }
        
        $order_list->where('orders.phar_id',$request->id);
        $order_list = $order_list->paginate(10);
        // echo $order_list->toSql(); die;
        return view('admin.revenue.view',['order_list' => $order_list,'pharmacy_details'=>$pharmacy_details]);
        
    }
    
    

}
