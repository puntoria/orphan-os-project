<div id="dialog">
	<h3>@{{ title }}</h3>
	<p>@{{ content }}</p>

	<div class="dialog-confirm" v-if="isConfirm">
		<div class="btn btn-primary" @click="setConfirm(true, callback)">Yes</div>
		<div class="btn btn-default" @click="setConfirm(false, callback)">No</div>
	</div>
</div>