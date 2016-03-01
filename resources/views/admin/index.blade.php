@extends('admin.base')

@section('app', 'orphans')

@section('page-content')

<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header">{{ trans('general.titles.orphan-list') }}</h3>
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
					{{ trans('general.stats.all') }} <span class="badge">@{{ stats.totalCount }}</span>
				</a>
			</li>
			<li :class="{ 'current' : showing == 'withDonation' }" class="tab">
				<a href="#" @click="filter('withDonation')">
					{{ trans('general.stats.with-donation') }} <span class="badge">@{{ stats.withDonationCount }}</span>
				</a>
			</li>
			<li :class="{ 'current' : showing == 'withoutDonation' }" class="tab">
				<a href="#" @click="filter('withoutDonation')">
					{{ trans('general.stats.without-donation') }} <span class="badge">@{{ stats.withoutDonationCount }}</span>
				</a>
			</li>

			<div class="pull-right">
				<select class="form-control pull-left" v-model="pageLength" @change="datatable.page.len(pageLength).draw()">
					<option v-for="length in possibleLengths" value="@{{ length }}">@{{ length }} {{ trans('general.stats.orphans-per-page') }}</option>
					<option value="-1">{{ trans('general.stats.all') }}</option>
				</select>
			</div>
		</ul>
	</div>

	<div class="col-lg-12">
		<table class="table" id="orphans-list">
			<thead>
				<tr>
					<th style="width: 5%;">#</th>
					<th style="width: 16%;">{{ trans('general.fields.orphan.general.donor') }}</th>
					<th style="width: 8%;">{{ trans('general.fields.orphan.general.has_donation') }}</th>
					<th style="width: 17%;">{{ trans('general.fields.orphan.general.first_name') }}</th>
					<th style="width: 17%;">{{ trans('general.fields.orphan.general.middle_name') }}</th>
					<th style="width: 17%;">{{ trans('general.fields.orphan.general.last_name') }}</th>
					<th style="width: 10%;">{{ trans('general.fields.orphan.residence.city') }}</th>
					<th style="width: 5%;">{{ trans('general.fields.orphan.general.video') }}</th>
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

	@include('admin.partials.modals.orphan')
	
@endsection