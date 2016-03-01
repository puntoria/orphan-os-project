@extends('admin.base')

@section('app', 'dashboard')

@section('page-content')

<div class="row dashboard-stats bottom-space">
	<div class="col-lg-12">
		<h1 class="page-header">{{ trans('general.menu.home') }}</h1>
	</div>

	<div class="col-lg-3 col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-users fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">@{{ stats.orphans.count }}</div>
						<div>{{ trans('general.extra.orphans-total') }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-green">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-user fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">@{{ stats.orphans.withDonation }}</div>
						<div>{{ trans('general.extra.orphans-with-donation') }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-red">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-user-times fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">@{{ stats.orphans.withoutDonation }}</div>
						<div>{{ trans('general.extra.orphans-without-donation') }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-user-md fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">@{{ stats.donors.count }}</div>
						<div>{{ trans('general.extra.donors-total') }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="row bottom-space">
	<div class="col-md-6">
		<div class="panel chart-container">
			<div class="panel-body">
				<ul class="legend">
					<li><div class="block" style="background-color: #F7464A;"></div> {{ trans('general.extra.orphans-with-donation') }}</li>
					<li><div class="block" style="background-color: #46BFBD;"></div> {{ trans('general.extra.orphans-without-donation') }}</li>
				</ul>
				<canvas width="300" height="300" id="orphans-chart"></canvas>
			</div>
		</div>
		<a href="{{ route('Api::OrphanCSV') }}" class="btn btn-link pull-right">{{ trans('general.extra.download-orphans-list') }}</a>
	</div>
	<!-- /.col-lg-8 -->
	<div class="col-md-6">
		<div class="panel chart-container">
			<div class="panel-body">
				<ul class="legend">
					<li><div class="block" style="background-color: #FDB45C;"></div> {{ trans('general.extra.donors-active') }}</li>
					<li><div class="block" style="background-color: #46BFBD;"></div> {{ trans('general.extra.donors-inactive') }}</li>
				</ul>
				<canvas width="300" height="300" id="donors-chart"></canvas>
			</div>
		</div>
		<a href="{{ route('Api::DonorCSV') }}" class="btn btn-link pull-right">{{ trans('general.extra.download-donors-list') }}</a>
	</div>
</div>

<div class="row">

	<div class="col-md-4">
		<div class="panel panel-list">
			<div class="panel-heading">
				<i class="fa fa-list fa-fw"></i> {{ trans('general.extra.latest-donors') }}
			</div>                        
			<div class="panel-body">
				<div class="list-group">
					<a v-for="donor in stats.donors.last" href="#donor" class="list-group-item">@{{ donor.name }}</a>

					<div>
						<a href="{{ route('Admin::donors') }}" class="btn btn-default btn-block">{{ trans('general.extra.view-all') }}</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="panel panel-list">
			<div class="panel-heading">
				<i class="fa fa-list fa-fw"></i> {{ trans('general.extra.latest-orphans') }}
			</div>                        
			<div class="panel-body">
				<div class="list-group">
					<a v-for="orphan in stats.orphans.last" href="#orphan" class="list-group-item">@{{ orphan.first_name_ar }} @{{ orphan.last_name_ar }}</a>

					<div>
						<a href="{{ route('Admin::orphans') }}" class="btn btn-default btn-block">{{ trans('general.extra.view-all') }}</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="panel panel-list">
			<div class="panel-heading">
				<i class="fa fa-list fa-fw"></i> {{ trans('general.extra.latest-users') }}
			</div>                        
			<div class="panel-body">
				<div class="list-group">
					<a v-for="user in stats.users" href="#user" class="list-group-item">@{{ user.name }}</a>

					@if(auth()->user()->isAdmin())
					<div>
						<a href="{{ route('Admin::users') }}#" class="btn btn-default btn-block">{{ trans('general.extra.view-all') }}</a>
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>

@endsection