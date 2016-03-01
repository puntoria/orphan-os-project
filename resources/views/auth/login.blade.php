@extends('app')

@section('body-classes', 'auth-page')

@section('content')

<div class="container">
	<div class="row">

		<div class="col-md-4 col-md-push-4 auth-form">
			<form method="POST" action="{{ route('Auth::postLogin') }}">

				<div class="header">
					<h1>{{ trans('general.auth.title') }}</h1>
					<h3>{{ trans('general.auth.description') }}</h3>
				</div>

				@if (count($errors) > 0)
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
				@endif

				{!! csrf_field() !!}

				<div class="form-group">
					<label>{{ trans('general.auth.email-username') }}</label>
					<input class="form-control" type="text" name="username" value="{{ old('username') }}">
				</div>

				<div class="form-group">
					<label>{{ trans('general.auth.password') }}</label>
					<input class="form-control" type="password" name="password" id="password">
				</div>

				<div class="row">
					<div class="form-group col-md-6">
						{{-- <label>Remember Me</label> --}}
						<input type="checkbox" name="remember" id="remember" class="cbx hide">
						<label class="lbl" for="remember" title="{{ trans('general.auth.remember-me') }}"></label>

					</div>

					<div class="form-group col-md-6">
						<input type="submit" class="btn btn-primary pull-right" name="submit" value="{{ trans('general.auth.login') }}">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection