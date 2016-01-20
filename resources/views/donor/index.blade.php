@extends('donor.base')

@section('app', 'donor-orphans-list')

@section('page-content')

<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header">Lista e jetimëve @{{ selected | json }}</h3>
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
			<input type="hidden" v-model="donorID" value="{{ auth()->user()->id }}">
			<table class="table table-striped table-bordered table-hover" id="donor-full-orphans-list">
				<thead>
					<tr>
						<th style="width: 5%;">#</th>
						<th style="width: 18%;">Emri</th>
						<th style="width: 18%;">Emri i Prindit</th>
						<th style="width: 18%;">Mbiemri</th>
						<th style="width: 13%;">Qyteti</th>
						<th style="width: 10%;">Video</th>
						<th style="width: 18%;"></th>
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