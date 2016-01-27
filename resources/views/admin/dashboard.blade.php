@extends('admin.base')

@section('app', 'dashboard')

@section('page-content')

<div class="row dashboard-stats bottom-space">
	<div class="col-lg-12">
		<h1 class="page-header">Ballina</h1>
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
						<div>Totali i jetimëve</div>
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
						<div>Jetimët me donacion</div>
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
						<div>Jetimët pa donacion</div>
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
						<div>Numri i donatorëve</div>
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
					<li><div class="block" style="background-color: #F7464A;"></div> Orphans With Donation</li>
					<li><div class="block" style="background-color: #46BFBD;"></div> Orphans Without Donation</li>
				</ul>
				<canvas width="300" height="300" id="orphans-chart"></canvas>
			</div>
		</div>
		<div class="btn btn-link pull-right">Sharko Listen e Jetimeve</div>
	</div>
	<!-- /.col-lg-8 -->
	<div class="col-md-6">
		<div class="panel chart-container">
			<div class="panel-body">
				<ul class="legend">
					<li><div class="block" style="background-color: #FDB45C;"></div> Active Donors</li>
					<li><div class="block" style="background-color: #46BFBD;"></div> Inactive Donors</li>
				</ul>
				<canvas width="300" height="300" id="donors-chart"></canvas>
			</div>
		</div>
		<div class="btn btn-link pull-right">Sharko Listen e Donatoreve</div>
	</div>
</div>

<div class="row">

	<div class="col-md-4">
		<div class="panel panel-list">
			<div class="panel-heading">
				<i class="fa fa-list fa-fw"></i> Donatoret e fundit te shtuar ne databaze
			</div>                        
			<div class="panel-body">
				<div class="list-group">
					<a v-for="donor in stats.donors.last" href="#donor" class="list-group-item">@{{ donor.name }}</a>

					<div>
						<a href="{{ route('Admin::donors') }}" class="btn btn-default btn-block">Shiko te gjithe</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="panel panel-list">
			<div class="panel-heading">
				<i class="fa fa-list fa-fw"></i> Jetimet e fundit te shtuar ne databaze
			</div>                        
			<div class="panel-body">
				<div class="list-group">
					<a v-for="orphan in stats.orphans.last" href="#orphan" class="list-group-item">@{{ orphan.first_name }} @{{ orphan.last_name }}</a>

					<div>
						<a href="{{ route('Admin::orphans') }}" class="btn btn-default btn-block">Shiko te gjithe</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="panel panel-list">
			<div class="panel-heading">
				<i class="fa fa-list fa-fw"></i> Analistet e fundit te shtuar ne databaze
			</div>                        
			<div class="panel-body">
				<div class="list-group">
					<a v-for="user in stats.users" href="#user" class="list-group-item">@{{ user.name }}</a>

					@if(auth()->user()->isAdmin())
					<div>
						<a href="{{ route('Admin::users') }}#" class="btn btn-default btn-block">Shiko te gjithe</a>
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>

@endsection