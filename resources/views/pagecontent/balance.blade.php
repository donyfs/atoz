@extends('template/index')
@section('content')
<div class="container">
	<div class="col-xs-12">
		<h2><strong>Prepaid Balance</strong></h2>
		@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
		<form action="{{route('BalancePost')}}" method="post">
			<div class="form-group">
				<input class="form-control" name="mobile_number" type="text" value="{{ old('mobile_number') }}" placeholder="Mobile Number">
			</div>
			<div class="form-group">
				<select name="value" class="form-control">
					<option>pilih</option>
					<option value="10000" {{ old('value')=='10000' ? 'selected="selected"' : '' }}>10.000</option>
					<option value="50000 " {{ old('value')=='50000' ? 'selected="selected"' : '' }}>50.000</option>
					<option value="100000" {{ old('value')=='100000' ? 'selected="selected"' : '' }}>100.000</option>
				</select>
			</div>
			<div class="form-group fixed-bottom">
				<button type="submit" class="btn btn-info btn-block">Submit</button>	
			</div>
		</form>
	</div>
</div>
@endsection