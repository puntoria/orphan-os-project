<div id="gallery">
	<div class="btn btn-default float-right close-gallery" @click="hide()"><i class="fa fa-times"></i></div>
	<div class="close-area" @click="hide()"></div>
	<img :src="current().name" class="gallery-image">

	<div class="image-data">
		<p>@{{ current().description }}</p>
		<div class="btn btn-default float-right" @click="previous()">{{ trans('general.actions.prev') }}</div>
		<div class="btn btn-default float-right" @click="next()">{{ trans('general.actions.next') }}</div>
	</div>
</div>