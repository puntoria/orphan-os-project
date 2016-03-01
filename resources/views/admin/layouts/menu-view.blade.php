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
			<li v-show="selected.length > 1">
				<a href="#" @click="downloadPdf()"><i class="fa fa-file-pdf-o"></i> {{ trans('general.actions.download-pdf') }}</a>
			</li>
		</ul>
	@endif
</li>
<li>
	<a href="{{ route('Admin::donors') }}">
		<i class="fa fa-user fa-fw"></i> {{ trans('general.menu.donor-list') }}
	</a>
</li>
<li>
	<a href="{{ route('Auth::logout') }}"><i class="fa fa-sign-out fa-fw"></i> {{ trans('general.actions.logout') }}</a>
</li>