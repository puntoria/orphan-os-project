@extends("$type.base")

@section('app', 'profile')

@section('page-content')

<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header">Profili im</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>

<div class="row">
	<div class="col-lg-4">
		<input type="hidden" v-model="userID" value="{{ auth()->user()->id }}">
		<form>
			<div class="form-group">
				<label>Emri</label>
				<input type="text" class="form-control" v-model="user.name">
			</div>

			<div class="form-group">
				<label>Emri kyçes</label>
				<input type="text" class="form-control" v-model="user.username">
			</div>

			<div class="form-group">
				<label>Email</label>
				<input type="text" class="form-control" v-model="user.email">
			</div>

			<div class="form-group">
				<label>Gjuha</label>
				<select class="form-control" v-model="user.language">
					<option value="al" :selected="user.language == 'al'">Shqip</option>
					<option value="ar-kw" :selected="user.language == 'ar-kw'">Arabisht</option>
				</select>
			</div>

			<div class="form-group">
				<label>Fjalekalimi</label>
				<input type="password" class="form-control" v-model="user.password">
			</div>

			<div class="form-group">
				<label>Konfirmo</label>
				<input type="password" class="form-control" v-model="user.password_confirmation">
			</div>

			<div class="form-group">
				<button type="button" class="btn btn-primary pull-right" @click="update()">Ruaj ndryshimet</button>
			</div>
		</form>
	</div>
</div>
@endsection