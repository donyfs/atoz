@extends('template/index')
@section('content')
<div class="container">
	<div class="col-xs-12">
		<h2><strong>Pay your order</strong></h2>
		@if (count($errors) > 0)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
		@if(\Session::has('alert'))
		<div class="alert alert-warning">
			<div>{{Session::get('alert')}}</div>
		</div>
		@endif
		<form action="{{route('payOrder')}}" method="post">
			<div class="form-group">
				<input class="form-control" name="order_no" type="text" placeholder="Order no." value="{{$orderNo}}">	
			</div>
			<div class="form-group fixed-bottom">
				<button type="submit" class="btn btn-info btn-block">Submit</button>	
			</div>
		</form>
	</div>
</div>
@endsection