@if(\Session::get('login')==TRUE)
	<div class="col-xs-12 breadcrumb">
		<div class="col-xs-4">
			<strong>Hello, {{Session::get('name')}}</strong>
			<p class="small"><span class="text-danger"><b>{{$unpaidOrder}}</b></span> unpaid order</p>
		</div>
		<div class="col-xs-8 text-right">
			<a href="{{route('balance')}}" class="text-info small"> <strong>Prepaid Balance</strong></a> |
			<a href="{{route('product')}}" class="text-info small"> <strong>Product Page</strong></a>  
		</div>
	</div>
@endif