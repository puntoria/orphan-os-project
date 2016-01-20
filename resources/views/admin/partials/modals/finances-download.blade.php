<!-- ORPHAN MASS UPDATE MODAL -->
<div class="modal fade" id="download-finances-modal" tabindex="-1" role="dialog" aria-labelledby="download-finances-modal">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Ndrysho te dhenat</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<button v-for="year in orphan.finances.years" class="btn btn-default" 
					@click="financesYear = year">@{{ year }}</button>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
</div>