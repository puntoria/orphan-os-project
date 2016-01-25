@extends('layouts.navbar')

@section('sidemenu')

<li class="sidebar-search">

	<i class="fa fa-search"></i>
	<input type="text" class="form-control" placeholder="Search..." v-model="search" @keyup.enter="this.datatable.search(this.search).draw();">

</li>

@include("admin.layouts.menu-" . auth()->user()->type)


@endsection