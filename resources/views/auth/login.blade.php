@extends('app')

@section('content')

<div class="container">

	<form method="POST" action="{{ route('Auth::postLogin') }}" class="col-sm-4 col-sm-push-4">
		
		<h1 style="margin-top: 200px;">Login</h1>

		@if (count($errors) > 0)
        	<ul>
        	    @foreach ($errors->all() as $error)
        	        <li>{{ $error }}</li>
        	    @endforeach
        	</ul>
    	@endif

		{!! csrf_field() !!}

		<div>
			Email
			<input class="form-control" type="text" name="username" value="{{ old('username') }}">
		</div>

		<div>
			Password
			<input class="form-control" type="password" name="password" id="password">
		</div>

		<div>
			<input type="checkbox" name="remember"> Remember Me
		</div>

		<div>
			<input type="submit" class="btn btn-primary pull-right" name="submit" value="Login">
		</div>
	</form>

</div>

@endsection