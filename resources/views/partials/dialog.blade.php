<div id="dialog">
	<h3>@{{ title }}</h3>
	<p>@{{ content }}</p>

	<div class="dialog-confirm" v-if="isConfirm">
		<div class="btn btn-default" @click="setConfirm(false, callback)">{{ trans('general.actions.no') }}</div>
		<div class="btn btn-link" @click="setConfirm(true, callback)">{{ trans('general.actions.yes') }}</div>
	</div>
</div>