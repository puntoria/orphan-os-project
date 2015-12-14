@extends('layouts.navbar')

@section('sidemenu')
<li class="sidebar-search">
	<div class="input-group custom-search-form">
		<input type="text" class="form-control" placeholder="Search...">
		<span class="input-group-btn">
			<button class="btn btn-default" type="button">
				<i class="fa fa-search"></i>
			</button>
		</span>
	</div>
	<!-- /input-group -->
</li>
<li>
	<a href="{{ route('Donor::dashboard') }}">
		<i class="fa fa-dashboard fa-fw"></i> Ballina
	</a>
</li>
<li>
	<a href="{{ route('Donor::orphans') }}">
		<i class="fa fa-users fa-fw"></i> Lista e jetimëve
	</a>
</li>
<li>
	<a href="#">
		<i class="fa fa-envelope fa-fw"></i> Dërgo email
	</a>
</li>
<li>
	<a href="#logout"><i class="fa fa-sign-out fa-fw"></i> Çkyçu</a>
</li>
@endsection