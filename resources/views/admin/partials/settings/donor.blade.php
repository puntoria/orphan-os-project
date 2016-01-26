<div class="dropdown">
	<a id="dLabel" type="button" class="fa fa-cog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	</a>
	<ul class="dropdown-menu pull-right row-dropdown table-row-settings" aria-labelledby="dLabel" data-donor-id="{{ $id }}">
		@if (auth()->user()->isAdmin())
			<li><a href="#" class="change">{{ trans('general.actions.change') }}</a></li>
			<li><a href="#" class="delete">{{ trans('general.actions.delete') }}</a></li>
		@else
			<li><a href="#">{{ trans('general.actions.no-options') }}</a></li>
		@endif

		<input type="hidden" class="row-donor-id" value="{{ $id }}">
	</ul>
</div>