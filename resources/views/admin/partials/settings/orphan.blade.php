<div class="dropdown">
	<a id="dLabel" type="button" class="fa fa-cog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	</a>
	<ul class="dropdown-menu multi-level pull-right row-dropdown table-row-settings" aria-labelledby="dLabel" data-orphan-id="{{ $id }}">
		<li><a href="{{ route('Api::Orphans::PDF', $id) }}">Shkarko PDF</a></li>

		@if( !empty($reports) )
		<li class="dropdown-submenu">
			<a class="finances" href="#">Shkarko Raportin Financiar</a>
			<ul class="dropdown-menu">
				@foreach ($reports as $report)
				<li><a href="{{ route('Api::Orphans::Report', ['id' => $id, 'year' => $report]) }}">{{ $report }}</a></li>
				@endforeach
			</ul>
		</li>
		@endif

		@if (auth()->user()->isAdmin())
			<li><a href="#" class="change">Ndrysho</a></li>
			<li class="separator"></li>
			<li><a href="#" class="delete">Fshije</a></li>
		@endif

		<input type="hidden" class="row-orphan-id" value="{{ $id }}">
	</ul>
</div>