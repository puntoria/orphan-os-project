@extends('admin.base')

@section('app', 'orphans')

@section('page-content')

<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header">Lista e jetimëve</h3>
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
			<li :class="{ 'current' : showing == 'withDonation' }" class="tab">
				<a href="#" @click="filter('withDonation')">
					Me donacion <span class="badge">@{{ stats.withDonationCount }}</span>
				</a>
			</li>
			<li :class="{ 'current' : showing == 'withoutDonation' }" class="tab">
				<a href="#" @click="filter('withoutDonation')">
					Pa donacion <span class="badge">@{{ stats.withoutDonationCount }}</span>
				</a>
			</li>

			<div class="pull-right">
				<select class="form-control pull-left" v-model="pageLength" @change="datatable.page.len(pageLength).draw()">
					<option v-for="length in possibleLengths" value="@{{ length }}">@{{ length }} jetimë për faqe</option>
					<option value="-1">Të gjithë</option>
				</select>
			</div>
		</ul>
	</div>

	<div class="col-lg-12">
		<table class="table" id="orphans-list">
			<thead>
				<tr>
					<th style="width: 5%;">#</th>
					<th style="width: 10%;">Donatori</th>
					<th style="width: 11%;">Donacion?</th>
					<th style="width: 18%;">Emri</th>
					<th style="width: 18%;">Emri i Babes</th>
					<th style="width: 18%;">Mbiemri</th>
					<th style="width: 10%;">Qyteti</th>
					<th style="width: 5%;">Video</th>
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