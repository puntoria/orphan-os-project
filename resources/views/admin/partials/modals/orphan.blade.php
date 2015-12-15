<!-- Modal -->
<div id="orphan">
<div class="modal fade" id="add-orphan-modal" tabindex="-1" role="dialog" aria-labelledby="add-orphan-modal">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Shto Jetim</h4>
			</div>
			<div class="modal-body">

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
					<input type="hidden" id="current-orphan-id" v-model="currentID" value="new">
					<!-- Step One: Personal Data -->
					<div role="tabpanel" class="tab-pane active" id="step-one-personal">
						<div class="row">
							<div class="col-md-6">
								<label>Emri</label>
								<input type="text" class="form-control" placeholder="Emri i jetimit" 
								value="@{{ orphan.first_name }}" v-model="orphan.first_name">

								<input type="text" class="form-control" placeholder="Emri i jetimit AR" 
								value="@{{ orphan.first_name_ar }}" v-model="orphan.first_name_ar">
							</div>

							<div class="col-md-6">
								<label>Mbiemri</label>
								<input type="text" class="form-control" placeholder="Mbiemri i jetimit"
								value="@{{ orphan.last_name }}" v-model="orphan.last_name">

								<input type="text" class="form-control" placeholder="Mbiemri i jetimit AR" 
								value="@{{ orphan.last_name_ar }}" v-model="orphan.last_name_ar">
							</div>

							<div class="col-md-6">
								<label>Emri i prindit</label>
								<input type="text" class="form-control" placeholder="Emri i prindit"
								value="@{{ orphan.middle_name }}" v-model="orphan.middle_name">

								<input type="text" class="form-control" placeholder="Emri i prindit AR" 
								value="@{{ orphan.middle_name_ar }}" v-model="orphan.middle_name_ar">
							</div>

							<div class="col-md-3">
								<label>Gjinia</label>
								<select class="form-control" placeholder="Gjinia" v-model="orphan.gender">
									<option value="0" :selected="orphan.gender == 0">Mashkull</option>
									<option value="1" :selected="orphan.gender == 1">Femer</option>
								</select>
							</div>

							<div class="col-md-3">
								<label>Ditelindja</label>
								<input type="text" class="form-control" placeholder="Ditelindja"
								value="@{{ orphan.birthday }}" v-model="orphan.birthday">
							</div>

							<div class="col-md-6">
								<label>Foto</label>
								<img src="#">
							</div>

							<div class="col-md-6">
								<div>
									<label>Video</label>
									<input type="text" class="form-control" placeholder="Video"
									value="@{{ orphan.video }}" v-model="orphan.video">
								</div>

								<div>
									<label>Gjendja Shendetesore</label>
									<select class="form-control" placeholder="Gjendja Shendetesore" 
									v-model="orphan.health_state">
										<option value="0" :selected="orphan.health_state == 0">I semure</option>
										<option value="1" :selected="orphan.health_state == 1">I shendoshe</option>
									</select>
								</div>

								<div>
									<label>Ka donacion?</label>
									<input type="radio" value="1" 
									:checked="orphan.has_donation == 1" v-model="orphan.has_donation"> Po
									<input type="radio" value="0"
									:checked="orphan.has_donation == 0" v-model="orphan.has_donation"> Jo
								</div>

								<div>
									<label>ID e donatorit</label>
									<input type="text" class="form-control" placeholder="Id e donatorit"
									value="@{{ orphan.donor_id }}" v-model="orphan.donor_id">
								</div>
							</div>
						</div>
					</div>

					<!-- Step Two: Information -->
					<div role="tabpanel" class="tab-pane" id="step-two-info">
						<div class="row">
							<div class="col-md-6">
								<label>ID</label>
								<input type="text" class="form-control" placeholder="ID"
								value="@{{ orphan.id }}" v-model="orphan.id">
							</div>

							<div class="col-md-6">
								<label>Nr. i telefonit</label>
								<input type="text" class="form-control" placeholder="Nr. i telefonit"
								value="@{{ orphan.phone }}" v-model="orphan.phone">
							</div>

							<div class="col-md-12">
								<label>Email</label>
								<input type="text" class="form-control" placeholder="Email"
								value="@{{ orphan.email }}" v-model="orphan.email">
							</div>

							<div class="col-md-12">
								<label>Nr. i leternjoftimit</label>
								<input type="text" class="form-control" placeholder="Nr. i leternjoftimit"
								value="@{{ orphan.national_id }}" v-model="orphan.national_id">
							</div>

							<div class="col-md-12">
								<label>Llogaria bankare</label>
								<input type="text" class="form-control" placeholder="Llogaria bankare"
								value="@{{ orphan.bank_id }}" v-model="orphan.bank_id">
							</div>
						</div>
					</div>

					<!-- Step Three: Family -->
					<div role="tabpanel" class="tab-pane" id="step-three-family">
						<div class="row">
							<div class="col-md-4">
								<label>Anetare</label>
								<input type="text" class="form-control" placeholder="Anetare"
								value="@{{ orphan.family.family_members }}" v-model="orphan.family.family_members">
							</div>

							<div class="col-md-4">
								<label>Vellezer</label>
								<input type="text" class="form-control" placeholder="Vellezer"
								value="@{{ orphan.family.brothers }}" v-model="orphan.family.brothers">
							</div>

							<div class="col-md-4">
								<label>Motra</label>
								<input type="text" class="form-control" placeholder="Motra"
								value="@{{ orphan.family.sisters }}" v-model="orphan.family.sisters">
							</div>

							<div class="col-md-4">
								<label>Pa dy prinder</label>
								<input type="radio" value="1"
								:checked="orphan.family.no_parents == 1" v-model="orphan.family.no_parents"> Po
								<input type="radio" value="0"
								:checked="orphan.family.no_parents == 0" v-model="orphan.family.no_parents"> Jo
							</div>

							<div class="col-md-8">
								<label>Vdekja e prinderit</label>
								<input type="text" class="form-control" placeholder="Vdekja e prinderit"
								value="@{{ orphan.family.parent_death }}" v-model="orphan.family.parent_death">
							</div>

							<div class="col-md-6">
								<label>Kujdestari</label>
								<input type="text" class="form-control" placeholder="Kujdestari"
								value="@{{ orphan.family.caretaker_name }}" v-model="orphan.family.caretaker_name">
							</div>

							<div class="col-md-6">
								<label>Afersia</label>
								<input type="text" class="form-control" placeholder="Afersia"
								value="@{{ orphan.family.caretaker_relation }}" v-model="orphan.family.caretaker_relation">
							</div>
						</div>
					</div>

					<!-- Step Four: Education -->
					<div role="tabpanel" class="tab-pane" id="step-four-education">
						<div class="row">
							<div class="col-md-8">
								<label>Niveli</label>
								<input type="text" class="form-control" placeholder="Niveli"
								value="@{{ orphan.education.level }}" v-model="orphan.education.level">
							</div>

							<div class="col-md-4">
								<label>Klasa</label>
								<select class="form-control" placeholder="Klasa"
								value="@{{ orphan.education.class }}" v-model="orphan.education.class">
									<option value="0" :selected="orphan.education.class == 0">Parashkollore</option>
									<option value="1" :selected="orphan.education.class == 1">1</option>
									<option value="2" :selected="orphan.education.class == 2">2</option>
									<option value="3" :selected="orphan.education.class == 3">3</option>
									<option value="4" :selected="orphan.education.class == 4">4</option>
									<option value="5" :selected="orphan.education.class == 5">5</option>
									<option value="6" :selected="orphan.education.class == 6">6</option>
								</select>
							</div>

							<div class="col-md-8">
								<label>Notat</label>
								<select class="form-control" placeholder="Notat" v-model="orphan.education.grades">
									<option value="1" :selected="orphan.education.grades == 1">Pa mjaftueshem</option>
									<option value="2" :selected="orphan.education.grades == 2">Mjaftueshem</option>
									<option value="3" :selected="orphan.education.grades == 3">Mire</option>
									<option value="4" :selected="orphan.education.grades == 4">Shume Mire</option>
									<option value="5" :selected="orphan.education.grades == 5">Shkelqyeshem</option>
								</select>
							</div>

							<div class="col-md-4">
								<label>Me pagese</label>
								<input type="radio" value="1" 
								:checked="orphan.education.with_pay == 1" v-model="orphan.education.with_pay"> Po
								<input type="radio" value="0" 
								:checked="orphan.education.with_pay == 0" v-model="orphan.education.with_pay"> Jo
							</div>
						</div>
					</div>

					<!-- Step Five: Residence -->
					<div role="tabpanel" class="tab-pane" id="step-five-residence">
						<div class="row">
							<div class="col-md-6">
								<label>Shteti</label>
								<input type="text" class="form-control" placeholder="Shteti"
								value="@{{ orphan.residence.country }}" v-model="orphan.residence.country">
							</div>

							<div class="col-md-6">
								<label>Qyteti</label>
								<input type="text" class="form-control" placeholder="Qyteti"
								value="@{{ orphan.residence.city }}" v-model="orphan.residence.city">
							</div>

							<div class="col-md-6">
								<label>Fshati</label>
								<input type="text" class="form-control" placeholder="Fshati"
								value="@{{ orphan.residence.village }}" v-model="orphan.residence.village">
							</div>

							<div class="col-md-6">
								<label>Pronesia</label>
								<select class="form-control" placeholder="Pronesia" v-model="orphan.residence.ownership">
									<option value="1" :selected="orphan.residence.ownership == 1">Personale</option>
									<option value="0" :selected="orphan.residence.ownership == 0">Me pagese</option>
								</select>
							</div>
						</div>
					</div>

					<!-- Step Six: Note -->
					<div role="tabpanel" class="tab-pane" id="step-six-note">
						<div class="row">
							<div class="col-md-12">
								<label>Flete falenderimi</label>
								<textarea class="form-control" placeholder="Flete falenderimi"
								v-model="orphan.note">@{{ orphan.note }}</textarea>
							</div>
						</div>
					</div>
				</div>


			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" @click="update">Save changes</button>
			</div>
		</div>
	</div>
</div>
</div>