<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Helpers\HelperOrder;
use Illuminate\Support\Facades\Session;
use App\ProductModel;
use App\OrderModel;
use Carbon\Carbon;
use App\Jobs\queueOrder;

class Product extends Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }
    
	function index(){
		return view('pagecontent/product');
	}

	public function productPost(Request $request)
	{
    	$this->validateForm($request);
		$order_no=HelperOrder::generateOrderNo();
		$user_id=Session::get('user_id');
		
		$data_product=array(
			'product'=>$request->product,
			'shipping_address'=>$request->shipping_address,
			'price'=>$request->price,
			'total'=>$request->price,
			);

		$insertProduct=ProductModel::create($data_product);

		$data_order=array(
			'status_order_id'=>4,
			'user_id'=>$user_id,
			'orderable_type'=>'App\ProductModel',
			'order_no'=>$order_no,
			'orderable_id'=>$insertProduct->id,
			);

		$insertOrder=OrderModel::create($data_order);
		queueOrder::dispatch($order_no)->delay(Carbon::now()->addMinutes(5));

		$orderTempt=array(
			'order_no'=>$order_no,
			'order_type'=>$data_order['orderable_type'],
			'product'=>$data_product['product'],
			'shipping_address'=>$data_product['shipping_address'],
			'price'=>$data_product['price'],
			'total'=>$insertProduct->total
			);
		Session::put('orderTempt',$orderTempt);
		return redirect('success');
	}

	function validateForm(Request $request){
		$this->validate($request,[
			'product' => 'required|between:10,150',
			'shipping_address' => 'required|between:10,150',
			'price' => 'required|numeric'
			]);
	}
}
