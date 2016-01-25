@extends('layouts.navbar')

@section('sidemenu')
<li class="sidebar-search">
	<i class="fa fa-search"></i>
	<input type="text" class="form-control" placeholder="Search..." v-model="search" @keyup.enter="this.datatable.search(this.search).draw();">
</li>
<li>
	<a href="{{ route('Donor::dashboard') }}">
		<i class="fa fa-dashboard fa-fw"></i> Ballina
	</a>

	@if( Request::is('donor/dashboard') )
		<ul class="nav nav-second-level collapse in" aria-expanded="true">
			<li v-show="selected.length > 1">
				<a href="#" @click="downloadPdf()"><i class="fa fa-file-pdf-o"></i> Shkarko PDF</a>
			</li>
		</ul>
	@endif
</li>
<li>
	<a href="{{ route('Donor::orphans') }}">
		<i class="fa fa-users fa-fw"></i> Lista e jetimëve
	</a>

	@if( Request::is('donor/orphans') )
		<ul class="nav nav-second-level collapse in" aria-expanded="true">
			<li v-show="selected.length > 0">
				<a href="#" @click="downloadPdf()"><i class="fa fa-file-pdf-o"></i> Shkarko PDF</a>
			</li>
		</ul>
	@endif
</li>
<li>
	<a href="#" id="send-normal-email">
		<i class="fa fa-envelope fa-fw"></i> Kontakto
	</a>
</li>
<li>
	<a href="{{ route('Auth::logout') }}"><i class="fa fa-sign-out fa-fw"></i> Çkyçu</a>
</li>
@endsection