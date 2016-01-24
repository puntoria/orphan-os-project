@extends('admin.base')

@section('app', 'donors')

@section('page-content')

<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header">Lista e donatorëve</h3>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<ul class="nav nav-pills table-tabs">
			<li>
				<a href="#" @click="selectAll($event)">
					<i class="fa" 
					:class="{ 'fa-check-square': selected.length > 0, 'fa-square': selected.length == 0 }"></i>
				</a>
			</li>
			<li :class="{ 'current' : showing == 'data' }" class="tab">
				<a href="#" @click="filter('data')">
					Të gjithë <span class="badge">@{{ stats.totalCount }}</span>
				</a>
			</li>
			<li :class="{ 'current' : showing == 'active' }" class="tab">
				<a href="#" @click="filter('active')">
					Aktiv <span class="badge">@{{ stats.activeCount }}</span>
				</a>
			</li>
			<li :class="{ 'current' : showing == 'inactive' }" class="tab">
				<a href="#" @click="filter('inactive')">
					Inaktiv <span class="badge">@{{ stats.inactiveCount }}</span>
				</a>
			</li>

			<div class="pull-right">
				<select class="form-control pull-left" v-model="pageLength" @change="datatable.page.len(pageLength).draw()">
					<option v-for="length in possibleLengths" value="@{{ length }}">@{{ length }} donatorë për faqe</option>
					<option value="-1">Të gjithë</option>
				</select>
			</div>
		</ul>
	</div>

	<div class="col-lg-12">
		<table class="table" id="donors-list">
			<thead>
				<tr>
					<th style="width: 5%;">#</th>
					<th style="width: 30%;">Emri</th>
					<th style="width: 30%;">Email</th>
					<th style="width: 15%;">Gjuha</th>
					<th style="width: 15%;">Aktiv?</th>
					<th style="width: 5%;"></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
	<!-- /.panel -->
</div>

@endsection

@section('modals')

	@include('admin.partials.modals.donor')

@endsection