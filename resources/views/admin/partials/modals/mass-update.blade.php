<!-- ORPHAN MASS UPDATE MODAL -->
<div class="modal fade" id="mass-update-modal" tabindex="-1" role="dialog" aria-labelledby="mass-update-modal">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">{{ trans('general.actions.change-data') }}</h4>
			</div>
			<div class="modal-body">
				<div class="row">

					<div class="list-group col-sm-4" id="accordion">
						<div class="panel">

							<a @click="massUpdateField.category = 'general'" data-parent="#accordion" class="list-group-item list-group-item-info" data-toggle="collapse" href="#collapseGeneral">
								{{ trans('general.fields.orphan.tabs.general') }}
							</a>

							<div class="collapse in" id="collapseGeneral">
								<a href="#" class="list-group-item" 
								@click="setMassUpdateField('gender', 'general')">{{ trans('general.fields.orphan.general.gender') }}</a>

								<a href="#" class="list-group-item" 
								@click="setMassUpdateField('health_state', 'general')">{{ trans('general.fields.orphan.general.health_state') }}</a>

								<a href="#" class="list-group-item" 
								@click="setMassUpdateField('has_donation', 'general')">{{ trans('general.fields.orphan.general.has_donation') }}</a>

								<a href="#" class="list-group-item" 
								@click="setMassUpdateField('no_parents', 'family')">{{ trans('general.fields.orphan.family.no_parents') }}</a>
							</div>

							<a @click="massUpdateField.category = 'education'" data-parent="#accordion" class="list-group-item list-group-item-info" data-toggle="collapse" href="#collapseEducation">
								{{ trans('general.fields.orphan.tabs.education') }}
							</a>
							<div class="collapse" id="collapseEducation">
								<a href="#" class="list-group-item" @click="massUpdateField.field = 'level'">{{ trans('general.fields.orphan.education.level') }}</a>
								<a href="#" class="list-group-item" @click="massUpdateField.field = 'class'">{{ trans('general.fields.orphan.education.class') }}</a>
								<a href="#" class="list-group-item" @click="massUpdateField.field = 'grades'">{{ trans('general.fields.orphan.education.grades') }}</a>
								<a href="#" class="list-group-item" @click="massUpdateField.field = 'with_pay'">{{ trans('general.fields.orphan.education.with_pay') }}</a>
							</div>

							<a @click="massUpdateField.category = 'residence'" data-parent="#accordion" class="list-group-item list-group-item-info" data-toggle="collapse" href="#collapseResidence">
								{{ trans('general.fields.orphan.tabs.residence') }}
							</a>
							<div class="collapse" id="collapseResidence">
								<a href="#" class="list-group-item" @click="massUpdateField.field = 'country'">{{ trans('general.fields.orphan.residence.country') }}</a>
								<a href="#" class="list-group-item" @click="massUpdateField.field = 'city'">{{ trans('general.fields.orphan.residence.city') }}</a>
								<a href="#" class="list-group-item" @click="massUpdateField.field = 'village'">{{ trans('general.fields.orphan.residence.village') }}</a>
								<a href="#" class="list-group-item" @click="massUpdateField.field = 'ownership'">{{ trans('general.fields.orphan.residence.property') }}</a>
							</div>
						</div>
					</div>
					<div class="col-sm-8 mass-update-fields-wrapper">
						<div class="row">

							<div v-if="massUpdateField.category == 'general' || massUpdateField.category == 'family'" class="mass-edit-field col-md-6">
								<div v-if="massUpdateField.field == 'gender'">
									<label>{{ trans('general.fields.orphan.general.gender') }}</label>
									<select class="form-control" v-model="massUpdateFields.general.gender">
										<option value="0" :selected="massUpdateFields.general.gender == 0">{{ trans('general.gender.male') }}</option>
										<option value="1" :selected="massUpdateFields.general.gender == 1">{{ trans('general.gender.female') }}</option>
									</select>
								</div>

								<div v-if="massUpdateField.field == 'health_state'">
									<label>{{ trans('general.fields.orphan.general.health_state') }}</label>
									<select class="form-control" v-model="massUpdateFields.general.health_state">
										<option value="0" :selected="massUpdateFields.general.health_state == 0">{{ trans('general.health_state.sick') }}</option>
										<option value="1" :selected="massUpdateFields.general.health_state == 1">{{ trans('general.health_state.healthy') }}</option>
									</select>
								</div>

								<div v-if="massUpdateField.field == 'has_donation'" class="centred-select">
									<label>{{ trans('general.fields.orphan.general.has_donation') }}</label>
									<input type="checkbox" class="cbx hide" id="mass_update_has_donation" 
									v-model="massUpdateFields.general.has_donation">
									<label for="mass_update_has_donation" class="lbl"></label>
								</div>

								<div v-if="massUpdateField.field == 'no_parents'" class="centred-select">
									<label>{{ trans('general.fields.orphan.family.no_parents') }}</label>
									<input type="checkbox" class="cbx hide" id="mass_update_no_parents" 
									v-model="massUpdateFields.family.no_parents">
									<label for="mass_update_no_parents" class="lbl"></label>
								</div>
							</div>

							<div v-if="massUpdateField.category == 'education'" class="mass-edit-field col-md-6">
								<div v-if="massUpdateField.field == 'level'">
									<label>{{ trans('general.fields.orphan.education.level') }}</label>
									<input type="text" class="form-control"
									value="@{{ massUpdateFields.education.level }}" v-model="massUpdateFields.education.level">
								</div>

								<div v-if="massUpdateField.field == 'class'">
									<label>{{ trans('general.fields.orphan.education.class') }}</label>
									<select class="form-control"
									value="@{{ massUpdateFields.education.class }}" v-model="massUpdateFields.education.class">
									<option value="0" :selected="massUpdateFields.education.class == 0">{{ trans('general.education.pre_school') }}</option>
									<option value="1" :selected="massUpdateFields.education.class == 1">1</option>
									<option value="2" :selected="massUpdateFields.education.class == 2">2</option>
									<option value="3" :selected="massUpdateFields.education.class == 3">3</option>
									<option value="4" :selected="massUpdateFields.education.class == 4">4</option>
									<option value="5" :selected="massUpdateFields.education.class == 5">5</option>
									<option value="6" :selected="massUpdateFields.education.class == 6">6</option>
								</select>
							</div>

							<div v-if="massUpdateField.field == 'grades'">
								<label>{{ trans('general.fields.orphan.education.grades') }}</label>
								<select class="form-control" placeholder="Notat" v-model="massUpdateFields.education.grades">
									<option value="1" :selected="massUpdateFields.education.grades == 1">{{ trans('general.education.grades.1') }}</option>
									<option value="2" :selected="massUpdateFields.education.grades == 2">{{ trans('general.education.grades.2') }}</option>
									<option value="3" :selected="massUpdateFields.education.grades == 3">{{ trans('general.education.grades.3') }}</option>
									<option value="4" :selected="massUpdateFields.education.grades == 4">{{ trans('general.education.grades.4') }}</option>
									<option value="5" :selected="massUpdateFields.education.grades == 5">{{ trans('general.education.grades.5') }}</option>
								</select>
							</div>

							<div v-if="massUpdateField.field == 'with_pay'" class="centred-select">
								<label>{{ trans('general.fields.orphan.education.with_pay') }}</label>
								<input type="checkbox" class="cbx hide" id="mass_update_with_pay" 
								v-model="massUpdateFields.education.with_pay">
								<label for="mass_update_with_pay" class="lbl"></label>
							</div>
						</div>

						<div v-if="massUpdateField.category == 'residence'" class="mass-edit-field col-md-6">
							<div v-if="massUpdateField.field == 'country'">
								<label>{{ trans('general.fields.orphan.residence.country') }}</label>
								<input type="text" class="form-control"
								value="@{{ massUpdateFields.residence.country }}" v-model="massUpdateFields.residence.country">
							</div>

							<div v-if="massUpdateField.field == 'city'">
								<label>{{ trans('general.fields.orphan.residence.city') }}</label>
								<input type="text" class="form-control"
								value="@{{ massUpdateFields.residence.city }}" v-model="massUpdateFields.residence.city">
							</div>

							<div v-if="massUpdateField.field == 'village'">
								<label>{{ trans('general.fields.orphan.residence.village') }}</label>
								<input type="text" class="form-control"
								value="@{{ massUpdateFields.residence.village }}" v-model="massUpdateFields.residence.village">
							</div>

							<div v-if="massUpdateField.field == 'ownership'">
								<label>{{ trans('general.fields.orphan.residence.property') }}</label>
								<select class="form-control" v-model="massUpdateFields.residence.ownership">
									<option value="1" :selected="massUpdateFields.residence.ownership == 1">{{ trans('general.residence.personal') }}</option>
									<option value="0" :selected="massUpdateFields.residence.ownership == 0">{{ trans('general.residence.with_pay') }}</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer col-sm-8">
					<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('general.actions.close') }}</button>
					<button type="button" class="btn btn-primary" @click="submitMassUpdate()">{{ trans('general.actions.save') }}</button>
				</div>
			</div>
		</div>
	</div>
</div>
</div>