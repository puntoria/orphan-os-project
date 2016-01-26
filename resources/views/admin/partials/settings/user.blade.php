<div class="dropdown">
	<a id="dLabel" type="button" class="fa fa-cog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	</a>
	<ul class="dropdown-menu pull-right row-dropdown table-row-settings" aria-labelledby="dLabel" data-user-id="{{ $id }}">
		<li><a href="#" class="change">{{ trans('general.actions.change') }}</a></li>
		<li><a href="#" class="delete">{{ trans('general.actions.delete') }}</a></li>
		<input type="hidden" class="row-user-id" value="{{ $id }}">
	</ul>
</div>