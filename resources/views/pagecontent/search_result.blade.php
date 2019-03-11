@foreach($orders as $order)
<hr>
<div class="row">
	<div class="col-xs-8">
		<p>{{$order->order_no}} &nbsp&nbsp&nbsp&nbsp Rp {{$order->total}}</p>
		@if($order->type=='balance')
		<strong>Rp {{$order->price}} for {{$order->product}}</strong>
		@elseif($order->type=='product')
		<strong>{{$order->product}} that costs Rp {{$order->price}}</strong>
		@endif
	</div>

	@if($order->status_order_id==4)
	<div class="col-xs-4">
		<div class="form-group">
			<a href="{{route('getOrderNo',$order->order_no)}}" class="btn btn-info btn-block">Pay now</a>	
		</div>
	</div>
	@elseif($order->status_order_id==1 and $order->type=='balance')
	<div class="col-xs-4 text-center">
		<h4 class="text-success"> Success</h4>
	</div>
	@elseif($order->status_order_id==1 and $order->type=='product')
	<div class="col-xs-4 text-center">
		<h6> Shipping code</h6>
		<h6> {{$order->shipping_code}}</h6>
	</div>
	@elseif($order->status_order_id==2)
	<div class="col-xs-4 text-center">
		<h4 class="text-warning"> Failed</h4>
	</div>
	@elseif($order->status_order_id==3)
	<div class="col-xs-4 text-center">
		<h4 class="text-danger"> Cancelled</h4>
	</div>
	@endif

</div>
@endforeach
<div class="row text-center">
	<ul class="pagination">
		{{ $orders->links() }}
	</ul> 
</div>