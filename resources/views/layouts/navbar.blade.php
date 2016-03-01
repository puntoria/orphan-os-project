<!-- Navigation -->
<nav class="main-navbar navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
	<i class="fa fa-bars toggle-sidebar"></i>

	<ul class="user-menu nav navbar-top-links navbar-right">
		<!-- /.dropdown -->
		<li class="dropdown">
			<a  href="{{ route('Profile::me') }}">
				<i class="fa fa-user fa-fw"></i> <span>{{ auth()->user()->name }}</span>
			</a>
			<!-- /.dropdown-user -->
		</li>
		<!-- /.dropdown -->
	</ul>
	<!-- /.navbar-top-links -->

	<div class="navbar-default sidebar" role="navigation">
		<div class="sidebar-nav navbar-collapse">
			<ul class="nav" id="side-menu">
				<li class="logo">
					<a href="{{ route('Auth::dashboard') }}">
						<span>Patient Help Fund</span>
					</a>
				</li>
				@yield('sidemenu')
			</ul>
		</div>
		<!-- /.sidebar-collapse -->
	</div>
	<!-- /.navbar-static-side -->
</nav>