@extends('admin.base')

@section('page-content')

<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header">Lista e jetimëve @{{ selected | json }}</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>

<!-- /.row -->
<div class="row">
	<div class="col-lg-12" style="margin-bottom: 15px;">
		<ul class="nav nav-pills">
			<li :class="{ 'disabled' : showing == 'data' }">
				<a href="#" @click="filter('data')">
					Të gjithë <span class="badge">@{{ orphans.data.length }}</span>
				</a>
			</li>
			<li :class="{ 'disabled' : showing == 'withDonation' }">
				<a href="#" @click="filter('withDonation')">
					Me donacion <span class="badge">@{{ orphans.withDonation.length }}</span>
				</a>
			</li>
			<li :class="{ 'disabled' : showing == 'withoutDonation' }">
				<a href="#" @click="filter('withoutDonation')">
					Pa donacion <span class="badge">@{{ orphans.withoutDonation.length }}</span>
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
		<!-- <pre>@{{ $data | json }}</pre> -->
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="orphans-list">
				<thead>
					<tr>
						<th style="width: 5%;">#</th>
						<th style="width: 10%;">Donatori</th>
						<th style="width: 5%;">Donacion?</th>
						<th style="width: 20%;">Emri</th>
						<th style="width: 20%;">Emri i Babes</th>
						<th style="width: 20%;">Mbiemri</th>
						<th style="width: 10%;">Qyteti</th>
						<th style="width: 5%;">Video</th>
						<th style="width: 5%;"></th>
					</tr>
				</thead>
				<tbody v-model="orphans">
				</tbody>
			</table>
		</div>
		<!-- /.table-responsive -->
	</div>
	<!-- /.panel -->
</div>


@endsection

@section('modals')

	@include('admin.partials.modals.orphan')

@endsection