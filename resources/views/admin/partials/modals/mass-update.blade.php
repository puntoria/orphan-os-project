<!-- ORPHAN MASS UPDATE MODAL -->
<div class="modal fade" id="mass-update-modal" tabindex="-1" role="dialog" aria-labelledby="mass-update-modal">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Ndrysho te dhenat</h4>
			</div>
			<div class="modal-body">
				<div class="row">

					<div class="list-group col-sm-4" id="accordion">
						<div class="panel">

							<a @click="massUpdateField.category = 'general'" data-parent="#accordion" class="list-group-item list-group-item-info" data-toggle="collapse" href="#collapseGeneral">
								Te pergjithshme
							</a>

							<div class="collapse in" id="collapseGeneral">
								<a href="#" class="list-group-item" @click="massUpdateField.field = 'gender'">Gjinia</a>
								<a href="#" class="list-group-item" @click="massUpdateField.field = 'health_state'">Gjendja Shendetsore</a>
								<a href="#" class="list-group-item" @click="massUpdateField.field = 'has_donation'">Ka Donacion?</a>
								<a href="#" class="list-group-item" @click="setMassUpdateField('no_parents', 'family')">Pa Dy Prinder?</a>
							</div>

							<a @click="massUpdateField.category = 'education'" data-parent="#accordion" class="list-group-item list-group-item-info" data-toggle="collapse" href="#collapseEducation">
								Edukimi
							</a>
							<div class="collapse" id="collapseEducation">
								<a href="#" class="list-group-item" @click="massUpdateField.field = 'level'">Niveli i shkollimit</a>
								<a href="#" class="list-group-item" @click="massUpdateField.field = 'class'">Klasa</a>
								<a href="#" class="list-group-item" @click="massUpdateField.field = 'grades'">Notat</a>
								<a href="#" class="list-group-item" @click="massUpdateField.field = 'with_pay'">Me Pagese?</a>
							</div>

							<a @click="massUpdateField.category = 'residence'" data-parent="#accordion" class="list-group-item list-group-item-info" data-toggle="collapse" href="#collapseResidence">
								Vendbanimi
							</a>
							<div class="collapse" id="collapseResidence">
								<a href="#" class="list-group-item" @click="massUpdateField.field = 'country'">Shteti</a>
								<a href="#" class="list-group-item" @click="massUpdateField.field = 'city'">Qyteti</a>
								<a href="#" class="list-group-item" @click="massUpdateField.field = 'village'">Fshati</a>
								<a href="#" class="list-group-item" @click="massUpdateField.field = 'ownership'">Pronesia</a>
							</div>
						</div>
					</div>
					<div class="col-sm-8 mass-update-fields-wrapper">

						<div v-if="massUpdateField.category == 'general' || massUpdateField.category == 'family'">
							<div class="col-md-6" v-if="massUpdateField.field == 'gender'">
								<label>Gjinia</label>
								<select class="form-control" placeholder="Gjinia" v-model="massUpdateFields.general.gender">
									<option value="0" :selected="massUpdateFields.general.gender == 0">Mashkull</option>
									<option value="1" :selected="massUpdateFields.general.gender == 1">Femer</option>
								</select>
							</div>

							<div class="col-md-6" v-if="massUpdateField.field == 'health_state'">
								<label>Gjendja Shendetesore</label>
								<select class="form-control" placeholder="Gjendja Shendetesore" v-model="massUpdateFields.general.health_state">
									<option value="0" :selected="massUpdateFields.general.health_state == 0">I semure</option>
									<option value="1" :selected="massUpdateFields.general.health_state == 1">I shendoshe</option>
								</select>
							</div>

							<div class="col-md-6" v-if="massUpdateField.field == 'has_donation'">
								<label>Ka donacion?</label>
								<input type="radio" value="1" 
								:checked="massUpdateFields.general.has_donation == 1" v-model="massUpdateFields.general.has_donation"> Po
								<input type="radio" value="0"
								:checked="massUpdateFields.general.has_donation == 0" v-model="massUpdateFields.general.has_donation"> Jo
							</div>

							<div class="col-md-6" v-if="massUpdateField.field == 'no_parents'">
								<label>Pa dy prinder</label>
								<input type="radio" value="1"
								:checked="massUpdateFields.family.no_parents == 1" v-model="massUpdateFields.family.no_parents"> Po
								<input type="radio" value="0"
								:checked="massUpdateFields.family.no_parents == 0" v-model="massUpdateFields.family.no_parents"> Jo
							</div>
						</div>

						<div v-if="massUpdateField.category == 'education'">
							<div class="col-md-6" v-if="massUpdateField.field == 'level'">
								<label>Niveli</label>
								<input type="text" class="form-control" placeholder="Niveli"
								value="@{{ massUpdateFields.education.level }}" v-model="massUpdateFields.education.level">
							</div>

							<div class="col-md-6" v-if="massUpdateField.field == 'class'">
								<label>Klasa</label>
								<select class="form-control" placeholder="Klasa"
								value="@{{ massUpdateFields.education.class }}" v-model="massUpdateFields.education.class">
								<option value="0" :selected="massUpdateFields.education.class == 0">Parashkollore</option>
								<option value="1" :selected="massUpdateFields.education.class == 1">1</option>
								<option value="2" :selected="massUpdateFields.education.class == 2">2</option>
								<option value="3" :selected="massUpdateFields.education.class == 3">3</option>
								<option value="4" :selected="massUpdateFields.education.class == 4">4</option>
								<option value="5" :selected="massUpdateFields.education.class == 5">5</option>
								<option value="6" :selected="massUpdateFields.education.class == 6">6</option>
							</select>
						</div>

						<div class="col-md-6" v-if="massUpdateField.field == 'grades'">
							<label>Notat</label>
							<select class="form-control" placeholder="Notat" v-model="massUpdateFields.education.grades">
								<option value="1" :selected="massUpdateFields.education.grades == 1">Pa mjaftueshem</option>
								<option value="2" :selected="massUpdateFields.education.grades == 2">Mjaftueshem</option>
								<option value="3" :selected="massUpdateFields.education.grades == 3">Mire</option>
								<option value="4" :selected="massUpdateFields.education.grades == 4">Shume Mire</option>
								<option value="5" :selected="massUpdateFields.education.grades == 5">Shkelqyeshem</option>
							</select>
						</div>

						<div class="col-md-6" v-if="massUpdateField.field == 'with_pay'">
							<label>Me pagese</label>
							<input type="radio" value="1" 
							:checked="massUpdateFields.education.with_pay == 1" v-model="massUpdateFields.education.with_pay"> Po
							<input type="radio" value="0" 
							:checked="massUpdateFields.education.with_pay == 0" v-model="massUpdateFields.education.with_pay"> Jo
						</div>
					</div>

					<div v-if="massUpdateField.category == 'residence'">
						<div class="col-md-6" v-if="massUpdateField.field == 'country'">
							<label>Shteti</label>
							<input type="text" class="form-control" placeholder="Shteti"
							value="@{{ massUpdateFields.residence.country }}" v-model="massUpdateFields.residence.country">
						</div>

						<div class="col-md-6" v-if="massUpdateField.field == 'city'">
							<label>Qyteti</label>
							<input type="text" class="form-control" placeholder="Qyteti"
							value="@{{ massUpdateFields.residence.city }}" v-model="massUpdateFields.residence.city">
						</div>

						<div class="col-md-6" v-if="massUpdateField.field == 'village'">
							<label>Fshati</label>
							<input type="text" class="form-control" placeholder="Fshati"
							value="@{{ massUpdateFields.residence.village }}" v-model="massUpdateFields.residence.village">
						</div>

						<div class="col-md-6" v-if="massUpdateField.field == 'ownership'">
							<label>Pronesia</label>
							<select class="form-control" placeholder="Pronesia" v-model="massUpdateFields.residence.ownership">
								<option value="1" :selected="massUpdateFields.residence.ownership == 1">Personale</option>
								<option value="0" :selected="massUpdateFields.residence.ownership == 0">Me pagese</option>
							</select>
						</div>
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" @click="submitMassUpdate">Save changes</button>
			</div>
		</div>
	</div>
</div>