<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Helpers\HelperOrder;

use App\OrderModel;
use App\BalanceModel;
use Carbon\Carbon;
use App\Jobs\queueOrder;

class Balance extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->middleware('auth');
	}

	public function index()
	{
		return view('pagecontent.balance');
	}

	function balancePost(Request $request){

		$this->validateForm($request);
		$order_no=HelperOrder::generateOrderNo();
		$user_id=Session::get('user_id');
		
		$data_balance=array(
			'mobile_number'=>$request->mobile_number,
			'value'=>$request->value,
			'total'=>$request->value,
			);

		$insertProduct=BalanceModel::create($data_balance);

		$data_order=array(
			'status_order_id'=>4,
			'user_id'=>$user_id,
			'orderable_type'=>'App\BalanceModel',
			'order_no'=>$order_no,
			'orderable_id'=>$insertProduct->id,
			);

		$insertOrder=OrderModel::create($data_order);
		queueOrder::dispatch($order_no)->delay(Carbon::now()->addMinutes(5));

		$orderTempt=array(
			'order_no'=>$order_no,
			'order_type'=>$data_order['orderable_type'],
			'mobile_number'=>$data_balance['mobile_number'],
			'price'=>$data_balance['value'],
			'total'=>$insertProduct	->total
			);
		Session::put('orderTempt',$orderTempt);
		return redirect('success');
	}

	function validateForm(Request $request){
		$this->validate($request,[
			'mobile_number' => 'required|between:7,12|regex:/(081)[0-9]/',
			'value'=>'required|in:10000,50000,100000'
			]);
	}

}
