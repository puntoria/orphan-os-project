@extends('admin.base')

@section('app', 'users')

@section('page-content')

<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header">{{ trans('general.titles.user-list') }}</h3>
	</div>
	<!-- /.col-lg-12 -->
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
					{{ trans('general.stats.all') }} <span class="badge">@{{ stats.totalCount }}</span>
				</a>
			</li>
			<li :class="{ 'current' : showing == 'active' }" class="tab">
				<a href="#" @click="filter('active')">
					{{ trans('general.stats.active') }} <span class="badge">@{{ stats.activeCount }}</span>
				</a>
			</li>
			<li :class="{ 'current' : showing == 'inactive' }" class="tab">
				<a href="#" @click="filter('inactive')">
					{{ trans('general.stats.inactive') }} <span class="badge">@{{ stats.inactiveCount }}</span>
				</a>
			</li>

			<div class="pull-right">
				<select class="form-control pull-left" v-model="pageLength" @change="datatable.page.len(pageLength).draw()">
					<option v-for="length in possibleLengths" value="@{{ length }}">@{{ length }} {{ trans('general.stats.users-per-page') }}</option>
					<option value="-1">{{ trans('general.stats.all') }}</option>
				</select>
			</div>
		</ul>
	</div>

	<div class="col-lg-12">
	<table class="table" id="users-list">
			<thead>
				<tr>
					<th style="width: 5%;">#</th>
					<th style="width: 30%;">{{ trans('general.fields.user.name') }}</th>
					<th style="width: 30%;">{{ trans('general.fields.user.email') }}</th>
					<th style="width: 15%;">{{ trans('general.fields.user.role') }}</th>
					<th style="width: 15%;">{{ trans('general.fields.user.language') }}</th>
					<th style="width: 15%;">{{ trans('general.fields.user.active') }}</th>
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

	@include('admin.partials.modals.user')

@endsection