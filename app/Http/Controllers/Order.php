<?php

namespace App\Http\Controllers;
use App\OrderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Pagination\Paginator ;
use Illuminate\Support\Collection;

class Order extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->middleware('auth');
	}

	public function index()
	{
		$orders=$this->getOrderData();
		
		return view('pagecontent.order_history',compact('orders'));
	}

	public function search(Request $request)
	{

		$keyword = $request->search;

		$orders = $this->getOrderData($keyword);
		return view('pagecontent.search_result',compact('orders'));
	}

	public function getOrderData($keyword='')
	{
		$user_id=Session::get('user_id');

		$balance=DB::table('orders')->select('order_no','user_id','status_order_id','mobile_number',DB::raw('null'),DB::raw('null'),'value','total',DB::raw("'balance' as type"),'orders.created_at')
		->join('balance', function ($join) {
			$join->on('orders.orderable_id', '=', 'balance.id')
			->where('orders.orderable_type', 'Like', '%BalanceModel');
		})->where('user_id','=',$user_id)->where('order_no','like',"%$keyword%");

		$data=DB::table('orders')->select('order_no','user_id','status_order_id','product','shipping_address','shipping_code','price','total',DB::raw("'product' as type"),'orders.created_at')
		->join('product', function ($join) {
			$join->on('orders.orderable_id', '=', 'product.id')
			->where('orders.orderable_type', 'Like', '%ProductModel');
		})->where('user_id','=',$user_id)->where('order_no','like',"%$keyword%")->union($balance)->get();


		$page = Input::get('page', 1);
		$paginate = 20;
		$data=collect($data)->sortByDesc('created_at');

		$offSet = ($page * $paginate) - $paginate;
		$itemsForCurrentPage = array_slice($data->toArray(), $offSet, $paginate, true);

		$orders = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurrentPage, count($data), $paginate, $page);
		$link=url()->current();;
		$orders->setPath($link);

		return $orders;
	}
}
