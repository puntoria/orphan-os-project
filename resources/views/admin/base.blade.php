@extends('app')
@section('content')

	<!-- Navbar and Sidebar -->
	@include('admin.layouts.navbar')

	<!-- Page Content -->
	<div id="page-wrapper">
		@yield('page-content')
	</div>

@endsection