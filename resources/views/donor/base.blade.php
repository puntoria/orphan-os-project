@extends('app')
@section('content')

	<!-- Navbar and Sidebar -->
	@include('donor.layouts.navbar')

	<!-- Page Content -->
	<div id="page-wrapper">
		@yield('page-content')
	</div>

@endsection