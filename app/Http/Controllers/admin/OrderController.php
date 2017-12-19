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

class OrderController
        extends Controller {

    use AuthenticatesUsers;

    /**
     * Function used to get particular user order list
     *    
     * @return type
     */
    public function getUserOrders(Request $request) {
        $user_details = User::where('id',
                        $request->id)->get();
        $order_list = Order::where('user_id',
                        $request->id);
        if ($request->search_text <> '') {
            $order_list->where('order_no',
                    'LIKE',
                    '%' . $request->search_text . '%');
        }
        if ($request->status <> '') {
            $order_list->where('order_status',
                    $request->status);
        }
        $order_list = $order_list->paginate(10);

        return view('admin.user.order',
                ['order_list' => $order_list],
                ['user_details' => $user_details]);
    }

    /**
     * Function used to get order details by order id
     *    
     * @return type
     */
    public function getUserOrdersDetails(Request $request) {

        $order_details = DB::table('order_items')->where('order_items.order_id',
                        $request->orderid)
                ->join('orders',
                        'order_items.order_id',
                        '=',
                        'orders.id')
                ->join('medicine',
                        'order_items.med_id',
                        '=',
                        'medicine.id')
                //->join('pharmacy', 'order_items.phar_id', '=', 'pharmacy.id')
                ->select('order_items.quantity',
                        'order_items.price',
                        'medicine.name',
                        'orders.delivery_charges',
                        'orders.total_amount')
                ->get();
        echo $order_details;
        die;
        //return view('admin.user.order',['order_details'=>$order_details]); 
    }

    /**
     * Function used to get pharmacy order details by order id
     *    
     * @return type
     */
    public function getPharmacyOrdersDetails(Request $request) {
        $order_details = DB::table('order_items')->where('order_items.order_id',
                        $request->orderid)
                ->join('orders',
                        'order_items.order_id',
                        '=',
                        'orders.id')
                ->join('medicine',
                        'order_items.med_id',
                        '=',
                        'medicine.id')
                //->join('pharmacy', 'order_items.phar_id', '=', 'pharmacy.id')
                ->select('order_items.quantity',
                        'order_items.price',
                        'medicine.name',
                        'orders.delivery_charges',
                        'orders.total_amount')
                ->get();
        echo $order_details;
        die;
        //return view('admin.user.order',['order_details'=>$order_details]); 
    }

    /**
     * Function used to get  order list
     *    
     * @return type
     */
    public function getOrders(Request $request) {

        $order_list = Order::select('orders.id',
                        'orders.order_no',
                        'orders.total_amount',
                        'orders.payment_type',
                        'orders.order_status',
                        'orders.delivery_charges',
                        'orders.created_at',
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
                    ->orwhere('users.first_name',
                            'LIKE',
                            '%' . $request->search_text . '%')
                    ->orwhere('pharmacy.name',
                            'LIKE',
                            '%' . $request->search_text . '%');
        }
        if ($request->status <> '') {
            $order_list->where('orders.order_status',
                    $request->status);
        }
        $order_list = $order_list->orderBy('id','desc')->paginate(10);
        return view('admin.order.order',['order_list' => $order_list]);
    }

}
