@extends('template/index')
@section('content')
<div class="container">
	<div class="col-xs-12">
		<h2><strong>Login</strong></h2>
		@if(\Session::has('alert'))
		<div class="alert alert-danger">
			<div>{{Session::get('alert')}}</div>
		</div>
		@endif
		@if(\Session::has('alert-success'))
		<div class="alert alert-success">
			<div>{{Session::get('alert-success')}}</div>
		</div>
		@endif
		@if (count($errors) > 0)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
		<form method="post" action="{{route('login_action')}}">
			<div class="form-group">
				<input class="form-control" name="email" type="email" value="{{old('email')}}" placeholder="Email">	
			</div>
			<div class="form-group">
				<input class="form-control" name="password" type="password"  placeholder="Password">	
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-info btn-block">Login</button>	
			</div>
			<div class="btn btn-block">
				<a href="{{route('register')}}">Register</a> 
			</div>
		</form>
	</div>
</div>
@endsection