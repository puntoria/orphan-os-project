@extends("$type.base")

@section('app', 'profile')

@section('page-content')

<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header">{{ trans('general.profile.my-profile') }}</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>

<div class="row">
	<div class="col-lg-4">
		<input type="hidden" v-model="userID" value="{{ auth()->user()->id }}">
		<form>
			<div class="form-group">
				<label>{{ trans('general.fields.user.name') }}</label>
				<input type="text" class="form-control" v-model="user.name">
			</div>

			<div class="form-group">
				<label>{{ trans('general.fields.user.username') }}</label>
				<input type="text" class="form-control" v-model="user.username">
			</div>

			<div class="form-group">
				<label>{{ trans('general.fields.user.email') }}</label>
				<input type="text" class="form-control" v-model="user.email">
			</div>

			<div class="form-group">
				<label>{{ trans('general.fields.user.language') }}</label>
				<select class="form-control" v-model="user.language">
					<option value="al" :selected="user.language == 'al'">{{ trans('general.languages.al') }}</option>
					<option value="en" :selected="user.language == 'en'">{{ trans('general.languages.en') }}</option>
					<option value="ar-kw" :selected="user.language == 'ar-kw'">{{ trans('general.languages.ar-kw') }}</option>
				</select>
			</div>

			<div class="form-group">
				<label>{{ trans('general.fields.user.password') }}</label>
				<input type="password" class="form-control" v-model="user.password">
			</div>

			<div class="form-group">
				<label>{{ trans('general.profile.confirm-password') }}</label>
				<input type="password" class="form-control" v-model="user.password_confirmation">
			</div>

			<div class="form-group">
				<button type="button" class="btn btn-primary pull-right" @click="update()">{{ trans('general.actions.save') }}</button>
			</div>
		</form>
	</div>
</div>
@endsection