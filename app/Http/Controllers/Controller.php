<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use View;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	public function __construct()
	{
		$this->middleware(function ($request, $next) {
			$user_id=Session::get('user_id');
			$unpaidOrder=DB::table('orders')->where('user_id',$user_id)->where('status_order_id',4)->count();
			View::share('unpaidOrder',$unpaidOrder);

			return $next($request);
		});
	}
}
