<!-- Modal -->
<div id="orphan">
<form id="add-orphan-form">
<div class="modal fade" id="add-orphan-modal" tabindex="-1" role="dialog" aria-labelledby="add-orphan-modal">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Shto Jetim</h4>
			</div>
			<div class="modal-body">
				<!-- 

				Personal:
				-. id
				-. first_name, first_name_ar
				-. middle_name, middle_name_ar
				-. last_name, last_name_ar
				-. gender
				-. birthday
				-. phone
				-. email
				- national_id
				- bank_id
				-. photo
				-. video
				-. health_state
				-. has_donation
				-. donor_id

				Personal - Structure
				
				-. id
				-. phone
				-. email
				- national_id
				- bank_id

				-->

				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active">
					<a href="#step-one-personal" aria-controls="step-one-personal" role="tab" data-toggle="tab">Personale</a>
					</li>
					<li role="presentation">
						<a href="#step-two-info" aria-controls="step-two-info" role="tab" data-toggle="tab">Informata</a>
					</li>
					<li role="presentation">
						<a href="#step-three-family" aria-controls="step-three-family" role="tab" data-toggle="tab">Familja</a>
					</li>
					<li role="presentation">
						<a href="#step-four-education" aria-controls="step-four-education" role="tab" data-toggle="tab">Edukimi</a>
					</li>
					<li role="presentation">
						<a href="#step-five-residence" aria-controls="step-five-residence" role="tab" data-toggle="tab">Vendbanimi</a>
					</li>
					<li role="presentation">
						<a href="#step-six-note" aria-controls="step-six-note" role="tab" data-toggle="tab">Flete falenderimi</a>
					</li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">

					<!-- Step One: Personal Data -->
					<div role="tabpanel" class="tab-pane active" id="step-one-personal">
						<div class="row">
							<div class="col-md-6">
								<label>Emri</label>
								<input type="text" class="form-control" placeholder="Emri i jetimit">
							</div>

							<div class="col-md-6">
								<label>Mbiemri</label>
								<input type="text" class="form-control" placeholder="Mbiemri i jetimit">
							</div>

							<div class="col-md-6">
								<label>Emri i prindit</label>
								<input type="text" class="form-control" placeholder="Emri i prindit">
							</div>

							<div class="col-md-3">
								<label>Gjinia</label>
								<select class="form-control" placeholder="Gjinia">
									<option>Mashkull</option>
									<option>Femer</option>
								</select>
							</div>

							<div class="col-md-3">
								<label>Ditelindja</label>
								<input type="date" class="form-control" placeholder="Ditelindja">
							</div>

							<div class="col-md-6">
								<label>Foto</label>
								<img src="#">
							</div>

							<div class="col-md-6">
								<div>
									<label>Video</label>
									<input type="text" class="form-control" placeholder="Video">
								</div>

								<div>
									<label>Gjendja Shendetesore</label>
									<input type="text" class="form-control" placeholder="Gjendja Shendetesore">
								</div>

								<div>
									<label>Ka donacion?</label>
									<input type="radio"> Po
									<input type="radio"> Jo
								</div>

								<div>
									<label>ID e donatorit</label>
									<input type="text" class="form-control" placeholder="Id e donatorit">
								</div>
							</div>
						</div>
					</div>

					<!-- Step Two: Information -->
					<div role="tabpanel" class="tab-pane" id="step-two-info">
						<div class="row">
							<div class="col-md-6">
								<label>ID</label>
								<input type="text" class="form-control" placeholder="ID">
							</div>

							<div class="col-md-6">
								<label>Nr. i telefonit</label>
								<input type="text" class="form-control" placeholder="Nr. i telefonit">
							</div>

							<div class="col-md-12">
								<label>Email</label>
								<input type="text" class="form-control" placeholder="Email">
							</div>

							<div class="col-md-12">
								<label>Nr. i leternjoftimit</label>
								<input type="text" class="form-control" placeholder="Nr. i leternjoftimit">
							</div>

							<div class="col-md-12">
								<label>Llogaria bankare</label>
								<input type="text" class="form-control" placeholder="Llogaria bankare">
							</div>
						</div>
					</div>

					<!-- Step Three: Family -->
					<div role="tabpanel" class="tab-pane" id="step-three-family">
						<div class="row">
							<div class="col-md-4">
								<label>Anetare</label>
								<input type="text" class="form-control" placeholder="Anetare">
							</div>

							<div class="col-md-4">
								<label>Vellezer</label>
								<input type="text" class="form-control" placeholder="Vellezer">
							</div>

							<div class="col-md-4">
								<label>Motra</label>
								<input type="text" class="form-control" placeholder="Motra">
							</div>

							<div class="col-md-4">
								<label>Pa dy prinder</label>
								<input type="radio"> Po
								<input type="radio"> Jo
							</div>

							<div class="col-md-8">
								<label>Vdekja e prinderit</label>
								<input type="date" class="form-control" placeholder="Vdekja e prinderit">
							</div>

							<div class="col-md-6">
								<label>Kujdestari</label>
								<input type="text" class="form-control" placeholder="Kujdestari">
							</div>

							<div class="col-md-6">
								<label>Afersia</label>
								<input type="text" class="form-control" placeholder="Afersia">
							</div>
						</div>
					</div>

					<!-- Step Four: Education -->
					<div role="tabpanel" class="tab-pane" id="step-four-education">
						<div class="row">
							<div class="col-md-8">
								<label>Niveli</label>
								<input type="text" class="form-control" placeholder="Niveli">
							</div>

							<div class="col-md-4">
								<label>Klasa</label>
								<select class="form-control" placeholder="Klasa">
									<option>1</option>
									<option>2</option>
									<option>3</option>
									<option>4</option>
									<option>5</option>
								</select>
							</div>

							<div class="col-md-8">
								<label>Notat</label>
								<select class="form-control" placeholder="Notat">
									<option>Mire</option>
									<option>Shume Mire</option>
									<option>Shkelqyeshem</option>
								</select>
							</div>

							<div class="col-md-4">
								<label>Me pagese</label>
								<input type="radio"> Po
								<input type="radio"> Jo
							</div>
						</div>
					</div>

					<!-- Step Five: Residence -->
					<div role="tabpanel" class="tab-pane" id="step-five-residence">
						<div class="row">
							<div class="col-md-6">
								<label>Shteti</label>
								<input type="text" class="form-control" placeholder="Shteti">
							</div>

							<div class="col-md-6">
								<label>Qyteti</label>
								<input type="text" class="form-control" placeholder="Qyteti">
							</div>

							<div class="col-md-6">
								<label>Fshati</label>
								<input type="text" class="form-control" placeholder="Fshati">
							</div>

							<div class="col-md-6">
								<label>Pronesia</label>
								<select class="form-control" placeholder="Pronesia">
									<option>Personale</option>
									<option>Me pagese</option>
								</select>
							</div>
						</div>
					</div>

					<!-- Step Six: Note -->
					<div role="tabpanel" class="tab-pane" id="step-six-note">
						<div class="row">
							<div class="col-md-12">
								<label>Flete falenderimi</label>
								<textarea class="form-control" placeholder="Flete falenderimi"></textarea>
							</div>
						</div>
					</div>
				</div>


			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" @click="test">Save changes</button>
			</div>
		</div>
	</div>
</div>
</form>
</div>