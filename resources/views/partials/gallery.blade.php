<div id="gallery">
	<div class="btn btn-default float-right" @click="hide()"><i class="fa fa-times"></i></div>
	<img :src="current().name" width="500">
	<p>@{{ current().description }}</p>
	
	<div class="btn btn-default float-right" @click="previous()">Prev</div>
	<div class="btn btn-default float-right" @click="next()">Next</div>
</div>