<div class="dropdown">
	<a id="dLabel" type="button" class="fa fa-cog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	</a>
	<ul class="dropdown-menu multi-level pull-right row-dropdown table-row-settings" aria-labelledby="dLabel" data-orphan-id="{{ $id }}">
		<li><a href="{{ route('Api::Orphans::PDF', $id) }}">{{ trans('general.actions.download-pdf') }}</a></li>

		@if( !empty($reports) )
		<li class="dropdown-submenu">
			<a class="finances" href="#">{{ trans('general.actions.download-report') }}</a>
			<ul class="dropdown-menu">
				@foreach ($reports as $report)
				<li><a href="{{ route('Api::Orphans::Report', ['id' => $id, 'year' => $report]) }}">{{ $report }}</a></li>
				@endforeach
			</ul>
		</li>
		@endif

		@if (auth()->user()->isAdmin())
			<li><a href="#" class="change">{{ trans('general.actions.change') }}</a></li>
			<li class="separator"></li>
			<li><a href="#" class="delete">{{ trans('general.actions.delete') }}</a></li>
		@endif

		<input type="hidden" class="row-orphan-id" value="{{ $id }}">
	</ul>
</div>