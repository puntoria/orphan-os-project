@extends('donor.base')

@section('app', 'donor-orphans-list')

@section('page-content')

<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header">{{ trans('general.titles.orphan-list') }}</h3>
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

			<div class="pull-right">
				<select class="form-control pull-left" v-model="pageLength" @change="datatable.page.len(pageLength).draw()">
					<option v-for="length in possibleLengths" value="@{{ length }}">@{{ length }} {{ trans('general.stats.orphans-per-page') }}</option>
					<option value="-1">{{ trans('general.stats.all') }}</option>
				</select>
			</div>
		</ul>
	</div>

	<div class="col-lg-12">
		<input type="hidden" v-model="donorID" value="{{ auth()->user()->id }}">
		<table class="table" id="donor-full-orphans-list">
			<thead>
				<tr>
					<th style="width: 5%;">#</th>
					<th style="width: 18%;">{{ trans('general.fields.orphan.general.first_name') }}</th>
					<th style="width: 18%;">{{ trans('general.fields.orphan.general.middle_name') }}</th>
					<th style="width: 18%;">{{ trans('general.fields.orphan.general.last_name') }}</th>
					<th style="width: 13%;">{{ trans('general.fields.orphan.residence.city') }}</th>
					<th style="width: 10%;">{{ trans('general.fields.orphan.general.video') }}</th>
					<th style="width: 18%;"></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
	<!-- /.panel -->
</div>

@endsection