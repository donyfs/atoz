<?php
namespace App\Helpers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HelperOrder {

	public static function generateOrderNo($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}

		$check_orderNo=DB::table('orders')->where('order_no',$randomString)->count();

		if (!$check_orderNo) {
			return strtoupper($randomString);
		} else{
			$this->generateOrderNo();
		}
	}

	public static function generateShippingCode($length = 8) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}

		$check_shippingCode=DB::table('product')->where('shipping_code',$randomString)->count();

		if (!$check_shippingCode) {
			return strtoupper($randomString);
		} else{
			$this->generateShippingCode();
		}
	}

	public static function rateOrderBalance(){
		
		$data_order=DB::select("select id from orders where status_order_id!=4 and date(created_at) = Date(NOW())");
		$data_success=DB::select("select id from orders where status_order_id=1 and date(created_at) = Date(NOW())");
		$total_order=( count($data_order) <= 0 )?1:count($data_order) ;
		$total_order_success=count($data_success);

		$rate_now=$total_order_success/$total_order;
		$success_rate=0.9;
		if (date('H')>=9 and date('H')>=17 ) {
			$success_rate=0.9;
		} else {
			$success_rate=0.4;
		}

		if ($rate_now>=$success_rate) {
			$status_order_id=2;
		}else {
			$status_order_id=1;
		}
		return $status_order_id;
	}

}