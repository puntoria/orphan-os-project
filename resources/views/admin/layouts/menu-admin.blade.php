<li>
	<a href="{{ route('Admin::dashboard') }}">
		<i class="fa fa-dashboard fa-fw"></i> {{ trans('general.menu.home') }}
	</a>
</li>
<li>
	<a href="{{ route('Admin::orphans') }}">
		<i class="fa fa-users fa-fw"></i> {{ trans('general.menu.orphan-list') }}
	</a>

	@if( Request::is('admin/orphans') )
		<ul class="nav nav-second-level collapse in" aria-expanded="true">
			<li>
				<a href="#" class="add-new-orphan-toggle">
					<i class="fa fa-user-plus"></i> {{ trans('general.actions.add-orphan') }}
				</a>
			</li>
	
			<li class="mass-update-orphans-toggle" v-show="selected.length > 1">
				<a href="#"><i class="fa fa-edit"></i> {{ trans('general.actions.change-data') }}</a>
			</li>
	
			<li v-show="selected.length > 1">
				<a href="#" @click="downloadPdf()"><i class="fa fa-file-pdf-o"></i> {{ trans('general.actions.download-pdf') }}</a>
			</li>
	
			<li class="mass-delete-orphans-toggle" v-show="selected.length > 1">
				<a href="#"><i class="fa fa-close"></i> {{ trans('general.actions.delete') }}</a>
			</li>
		</ul>
	@endif
</li>
<li>
	<a href="{{ route('Admin::donors') }}">
		<i class="fa fa-user fa-fw"></i> {{ trans('general.menu.donor-list') }}
	</a>

	@if( Request::is('admin/donors') )
		<ul class="nav nav-second-level collapse in" aria-expanded="true">
			<li>
				<a href="#" class="add-new-donor-toggle">
					<i class="fa fa-user-plus"></i> {{ trans('general.actions.add-donor') }}
				</a>
			</li>
	
			<li class="mass-delete-donors-toggle" v-show="selected.length > 1">
				<a href="#">
					<i class="fa fa-close"></i> {{ trans('general.actions.delete') }}
				</a>
			</li>
		</ul>
	@endif
</li>
<li>
	<a href="{{ route('Admin::users') }}">
		<i class="fa fa-shield fa-fw"></i> {{ trans('general.menu.users') }}
	</a>

	@if( Request::is('admin/users') )
		<ul class="nav nav-second-level collapse in" aria-expanded="true">
			<li>
				<a href="#" class="add-new-user-toggle">
					<i class="fa fa-user-plus"></i> {{ trans('general.actions.add-user') }}
				</a>
			</li>
	
			<li class="mass-delete-users-toggle" v-show="selected.length > 1">
				<a href="#">
					<i class="fa fa-close"></i> {{ trans('general.actions.delete') }}
				</a>
			</li>
		</ul>
	@endif
</li>
<li>
	<a href="{{ route('Auth::logout') }}"><i class="fa fa-sign-out fa-fw"></i> {{ trans('general.actions.logout') }}</a>
</li>