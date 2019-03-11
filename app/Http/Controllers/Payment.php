<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Helpers\HelperOrder;
use App\OrderModel;
use App\ProductModel;

class Payment extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }
    public function index()
    {
    	$orderNo='';
    	if (Session::has('orderTempt')) {
    		$orderNo=Session::get('orderTempt')['order_no'];
    		Session::forget('orderTempt');
    	} 
        return view('pagecontent.payment',['orderNo'=>$orderNo]);
    }

    public function getOrderNo($orderNo)
    {
        $orderTempt=array('order_no'=>$orderNo);
    	Session::put('orderTempt',$orderTempt);
        return redirect('payment');
    }

    public function payOrder(Request $request){
    	$this->validateForm($request);
        $user_id=Session::get('user_id');
        $order=OrderModel::where('order_no',$request->order_no)->where('user_id',$user_id)->get()->first();

        if ($order->status_order_id==1) {
            return redirect('payment')->with('alert','order is paid');
        } elseif($order->status_order_id==2) {
            return redirect('payment')->with('alert','order is failed');
        } elseif($order->status_order_id==3) {
            return redirect('payment')->with('alert','order is cancelled');
        } elseif($order->status_order_id==4) {

            if($order->orderable_type=='App\BalanceModel'){
                $status_order_id=HelperOrder::rateOrderBalance();
                $update=OrderModel::where('order_no',$request->order_no)->update(['status_order_id'=>$status_order_id]);
            } elseif ($order->orderable_type=='App\ProductModel') {
                $shipping_code=HelperOrder::generateShippingCode();
                $data_order=OrderModel::where('order_no',$request->order_no);
                $id_product=$data_order->get()->first()->orderable_id;

                $update_product=ProductModel::where('id',$id_product)->update(['shipping_code'=>$shipping_code]);
                $update_order=$data_order->update(['status_order_id'=>1]);
            }

            return redirect('order');
        }
        
    }

    function validateForm(Request $request){
      $this->validate($request,[
       'order_no' => 'required|size:10'
       ]);
  }
}
