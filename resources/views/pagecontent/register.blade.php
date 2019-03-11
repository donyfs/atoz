@extends('template/index')
@section('content')
<div class="container">
	<div class="col-xs-12">
		<h2><strong>Register</strong></h2>
		@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
		<form method="post" action="{{route('register_action')}}">
			<div class="form-group">
				<input class="form-control" name="name" type="text" value="{{old('name')}}" placeholder="Name">	
			</div>
			<div class="form-group">
				<input class="form-control" name="email" type="email" value="{{old('email')}}" placeholder="Email">	
			</div>
			<div class="form-group">
				<input class="form-control" name="password" type="password" value="{{old('password')}}" placeholder="Password">	
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-info btn-block">Register</button>	
			</div>
			<div class="btn btn-block">
				<a href="{{route('login')}}">Login</a> 
			</div>
		</form>
	</div>
</div>
@endsection