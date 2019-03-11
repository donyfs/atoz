@extends('template/index')
@section('content')
<div class="container">
	<div class="col-xs-12">
		<?php // print_r(\Session::get('data'));die; ?>
		<h2><strong>Success!</strong></h2>
		<div class="row">
			<div class="col-xs-6 text-left">
				<p>Order no.</p>
				<p>Total</p>
			</div>
			<div class="col-xs-6 text-right">
				<p>{{Session::get('order_no')}}</p>
				<p>Rp {{Session::get('total')}}</p>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				@if(Session::get('orderable_type')=='App\BalanceModel')
				<p>Your mobile phone number {{Session::get('mobile_number')}} will receive Rp {{Session::get('price')}}</p>
				@elseif(Session::get('orderable_type')=='App\ProductModel')
				<p>{{Session::get('product')}} that costs {{Session::get('price')}} will be shipped to:</p>
				<p>{{Session::get('shipping_address')}}</p>
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