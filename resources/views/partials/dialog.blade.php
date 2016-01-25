<div id="dialog">
	<h3>@{{ title }}</h3>
	<p>@{{ content }}</p>

	<div class="dialog-confirm" v-if="isConfirm">
		<div class="btn btn-default" @click="setConfirm(false, callback)">No</div>
		<div class="btn btn-link" @click="setConfirm(true, callback)">Yes</div>
	</div>
</div>