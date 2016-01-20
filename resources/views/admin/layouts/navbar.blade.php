@extends('layouts.navbar')

@section('sidemenu')

<li class="sidebar-search">
	<div class="input-group custom-search-form">
		<input type="text" class="form-control" placeholder="Search..." v-model="search" @keyup.enter="this.datatable.search(this.search).draw();">
		<span class="input-group-btn">
			<button class="btn btn-default" type="button" @click="this.datatable.search(this.search).draw();">
				<i class="fa fa-search"></i>
			</button>
		</span>
	</div>
	<!-- /input-group -->
</li>

@include("admin.layouts.menu-" . auth()->user()->type)


@endsection