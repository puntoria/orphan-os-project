<li>
	<a href="{{ route('Admin::dashboard') }}">
		<i class="fa fa-dashboard fa-fw"></i> Ballina
	</a>
</li>
<li>
	<a href="{{ route('Admin::orphans') }}">
		<i class="fa fa-users fa-fw"></i> Lista e jetimëve
	</a>

	@if( Request::is('admin/orphans') )
		<ul class="nav nav-second-level collapse in" aria-expanded="true">
			<li>
				<a href="#"><i class="fa fa-file-pdf-o"></i> Shkarko PDF</a>
			</li>
	
			<li>
				<a href="#"><i class="fa fa-file-text-o"></i> Shkaro Raportin Financiar</a>
			</li>
		</ul>
	@endif
</li>
<li>
	<a href="{{ route('Admin::donors') }}">
		<i class="fa fa-user fa-fw"></i> Lista e donatorëve
	</a>
</li>
<li>
	<a href="{{ route('Auth::logout') }}"><i class="fa fa-sign-out fa-fw"></i> Çkyçu</a>
</li>