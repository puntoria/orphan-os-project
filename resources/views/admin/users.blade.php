@extends('admin.base')

@section('app', 'users')

@section('page-content')

<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header">Lista e përdoruesve @{{ selected | json }}</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>

<div class="row">
	<div class="col-lg-12" style="margin-bottom: 15px;">
		<ul class="nav nav-pills">
			<li>
				<a href="#" @click="selectAll($event)">
					<i class="fa" 
					:class="{ 'fa-check-square': selected.length > 0, 'fa-square': selected.length == 0 }"></i>
				</a>
			</li>
			<li :class="{ 'disabled' : showing == 'data' }">
				<a href="#" @click="filter('data')">
					Të gjithë <span class="badge">@{{ stats.totalCount }}</span>
				</a>
			</li>
			<li :class="{ 'disabled' : showing == 'active' }">
				<a href="#" @click="filter('active')">
					Aktiv <span class="badge">@{{ stats.activeCount }}</span>
				</a>
			</li>
			<li :class="{ 'disabled' : showing == 'inactive' }">
				<a href="#" @click="filter('inactive')">
					Inaktiv <span class="badge">@{{ stats.inactiveCount }}</span>
				</a>
			</li>

			<div class="pull-right">
				<select class="form-control pull-left" v-model="pageLength" @change="datatable.page.len(pageLength).draw()">
					<option v-for="length in possibleLengths" value="@{{ length }}">@{{ length }} përdorues për faqe</option>
					<option value="-1">Të gjithë</option>
				</select>
			</div>
		</ul>
	</div>

	<div class="col-lg-12">
		<!-- <pre>@{{ $data | json }}</pre> -->
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="users-list">
				<thead>
					<tr>
						<th style="width: 5%;">#</th>
						<th style="width: 30%;">Emri</th>
						<th style="width: 30%;">Email</th>
						<th style="width: 15%;">Roli</th>
						<th style="width: 15%;">Gjuha</th>
						<th style="width: 15%;">Aktiv?</th>
						<th style="width: 5%;"></th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
		<!-- /.table-responsive -->
	</div>
	<!-- /.panel -->
</div>

@endsection

@section('modals')

	@include('admin.partials.modals.user')

@endsection