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
				<a href="#" data-toggle="modal" data-target="#add-orphan-modal">
					<i class="fa fa-user-plus"></i> Shto Jetim
				</a>
			</li>
	
			<li>
				<a href="#"><i class="fa fa-edit"></i> Ndrysho të dhënat</a>
			</li>
	
			<li>
				<a href="#"><i class="fa fa-file-pdf-o"></i> Shkarko PDF</a>
			</li>
	
			<li>
				<a href="#"><i class="fa fa-file-text-o"></i> Shkaro Raportin Financiar</a>
			</li>
	
			<li>
				<a href="#"><i class="fa fa-close"></i> Fshij</a>
			</li>
		</ul>
	@endif
</li>
<li>
	<a href="{{ route('Admin::donors') }}">
		<i class="fa fa-user fa-fw"></i> Lista e donatorëve
	</a>

	@if( Request::is('admin/donors') )
		<ul class="nav nav-second-level collapse in" aria-expanded="true">
			<li>
				<a href="#" data-toggle="modal" data-target="#add-donator-modal">
					<i class="fa fa-user-plus"></i> Shto donator
				</a>
			</li>
	
			<li>
				<a href="#">
					<i class="fa fa-close"></i> Fshij
				</a>
			</li>
		</ul>
	@endif
</li>
<li>
	<a href="{{ route('Admin::users') }}">
		<i class="fa fa-shield fa-fw"></i> Përdoruesit
	</a>

	@if( Request::is('admin/users') )
		<ul class="nav nav-second-level collapse in" aria-expanded="true">
			<li>
				<a href="#" data-toggle="modal" data-target="#add-user-modal">
					<i class="fa fa-user-plus"></i> Shto përdorues
				</a>
			</li>
	
			<li>
				<a href="#">
					<i class="fa fa-close"></i> Fshij
				</a>
			</li>
		</ul>
	@endif
</li>
<li>
	<a href="{{ route('Auth::logout') }}"><i class="fa fa-sign-out fa-fw"></i> Çkyçu</a>
</li>