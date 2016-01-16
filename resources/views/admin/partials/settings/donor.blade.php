<div class="dropdown">
	<a id="dLabel" type="button" class="fa fa-cog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	</a>
	<ul class="dropdown-menu pull-right row-dropdown table-row-settings" aria-labelledby="dLabel" data-donor-id="{{ $id }}">
		@if (auth()->user()->isAdmin())
			<li><a href="#" class="change">Ndrysho</a></li>
			<li><a href="#" class="delete">Fshije</a></li>
		@else
			<li><a href="#">No options available</a></li>
		@endif

		<input type="hidden" class="row-donor-id" value="{{ $id }}">
	</ul>
</div>