<div id="videoplayer" :width="width" :height="height + 50">
	<div class="btn btn-default float-right close-player" @click="hide()"><i class="fa fa-times"></i></div>
	<div class="close-area" @click="hide()"></div>
	<iframe v-if="source != false" :width="width" :height="height" :src="source" frameborder="0">
	</iframe>
</div>