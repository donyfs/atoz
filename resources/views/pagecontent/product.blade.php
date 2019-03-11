@extends('template/index')
@section('content')
<div class="container">
	<div class="col-xs-12">
		<h2><strong>Product Page</strong></h2>
		@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
		<form action="{{route('productPost')}}" method="post">
			<div class="form-group">
				<textarea class="form-control" name="product" rows="4" value="{{ old('product') }}" placeholder="Product"></textarea>	
			</div>
			<div class="form-group">
				<textarea class="form-control" name="shipping_address" rows="4" value="{{ old('shipping_address') }}" placeholder="Shipping Address"></textarea>	
			</div>
			<div class="form-group">
				<input class="form-control" name="price" type="text" placeholder="Price" value="{{ old('price') }}">	
			</div>
			<div class="form-group fixed-bottom">
				<button type="submit" class="btn btn-info btn-block">Submit</button>	
			</div>
		</form>
	</div>
</div>
@endsection