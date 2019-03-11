@extends('template/index')
@section('content')
<div class="container">
	<div class="col-xs-12">
		<?php $order=Session::get('orderTempt');?>
		<h2><strong>Success!</strong></h2>
		<div class="row">
			<div class="col-xs-6 text-left">
				<p>Order no.</p>
				<p>Total</p>
			</div>
			<div class="col-xs-6 text-right">
				<p>{{$order['order_no']}}</p>
				<p>Rp {{$order['total']}}</p>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				@if($order['order_type']=='App\BalanceModel')
				<p>Your mobile phone number {{$order['mobile_number']}} will receive Rp {{$order['price']}}</p>
				@elseif($order['order_type']=='App\ProductModel')
				<p>{{$order['product']}} that costs {{$order['price']}} will be shipped to:</p>
				<p>{{$order['shipping_address']}}</p>
				<p>only after you pay.</p>
				@endif
			</div>
		</div>
		<div class="form-group">
			<a href="{{route('payment')}}" class="btn btn-info btn-block">Pay now</a>	
		</div>
	</div>
</div>
@endsection