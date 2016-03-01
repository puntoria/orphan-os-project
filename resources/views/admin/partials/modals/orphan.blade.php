<!-- Modal -->
<div id="orphan">
	<div class="modal fade" id="add-orphan-modal" tabindex="-1" role="dialog" aria-labelledby="add-orphan-modal">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">{{ trans('general.actions.add-orphan') }}</h4>
				</div>
				<div class="modal-body">

					<!-- Nav tabs -->
					<ul class="nav nav-tabs table-tabs" role="tablist">
						<li class="tab active">
							<a href="#step-one-personal" aria-controls="step-one-personal" role="tab" data-toggle="tab">
								{{ trans('general.fields.orphan.tabs.personal') }}
							</a>
						</li>
						<li class="tab">
							<a href="#step-two-info" aria-controls="step-two-info" role="tab" data-toggle="tab">
								{{ trans('general.fields.orphan.tabs.info') }}
							</a>
						</li>
						<li class="tab">
							<a href="#step-three-family" aria-controls="step-three-family" role="tab" data-toggle="tab">
								{{ trans('general.fields.orphan.tabs.family') }}
							</a>
						</li>
						<li class="tab">
							<a href="#step-four-education" aria-controls="step-four-education" role="tab" data-toggle="tab">
								{{ trans('general.fields.orphan.tabs.education') }}
							</a>
						</li>
						<li class="tab">
							<a href="#step-five-residence" aria-controls="step-five-residence" role="tab" data-toggle="tab">
								{{ trans('general.fields.orphan.tabs.residence') }}
							</a>
						</li>
						<li class="tab">
							<a href="#step-docs" aria-controls="step-docs" role="tab" data-toggle="tab">
								{{ trans('general.fields.orphan.tabs.documents') }}
							</a>
						</li>
						<li class="tab">
							<a href="#step-six-note" aria-controls="step-six-note" role="tab" data-toggle="tab">
								{{ trans('general.fields.orphan.tabs.note') }}
							</a>
						</li>
						<li class="tab" v-if="currentID != 'new'">
							<a href="#step-seven-reports" aria-controls="step-seven-reports" role="tab" data-toggle="tab">
								{{ trans('general.fields.orphan.tabs.reports') }}
							</a>
						</li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
						<input type="hidden" id="current-orphan-id" v-model="currentID" value="blank">
						<!-- Step One: Personal Data -->
						<div role="tabpanel" class="tab-pane active" id="step-one-personal">
							<div class="row">
								<div class="col-md-6 form-group" v-show="lang == 'al'">
									<label>{{ trans('general.fields.orphan.general.first_name') }} <span @click="lang = 'ar'">({{ trans('general.languages.local.albanian') }})</span></label>
									<input type="text" class="form-control"
									v-model="orphan.first_name">
								</div>

								<div class="col-md-6 form-group" v-show="lang == 'ar'">
									<label>{{ trans('general.fields.orphan.general.first_name') }} <span @click="lang = 'al'">({{ trans('general.languages.local.arabic') }})</span></label>
									<input type="text" class="form-control"
									v-model="orphan.first_name_ar">
								</div>

								<div class="col-md-6 form-group" v-show="lang == 'al'">
									<label>{{ trans('general.fields.orphan.general.last_name') }} <span @click="lang = 'ar'">({{ trans('general.languages.local.albanian') }})</span></label>
									<input type="text" class="form-control"
									v-model="orphan.last_name">
								</div>

								<div class="col-md-6 form-group" v-show="lang == 'ar'">
									<label>{{ trans('general.fields.orphan.general.last_name') }} <span @click="lang = 'al'">({{ trans('general.languages.local.arabic') }})</span></label>
									<input type="text" class="form-control"
									v-model="orphan.last_name_ar">
								</div>

								<div class="col-md-6 form-group" v-show="lang == 'al'">
									<label>{{ trans('general.fields.orphan.general.middle_name') }} <span @click="lang = 'ar'">({{ trans('general.languages.local.albanian') }})</span></label>
									<input type="text" class="form-control"
									v-model="orphan.middle_name">
								</div>

								<div class="col-md-6 form-group" v-show="lang == 'ar'">
									<label>{{ trans('general.fields.orphan.general.middle_name') }} <span @click="lang = 'al'">({{ trans('general.languages.local.arabic') }})</span></label>
									<input type="text" class="form-control"
									v-model="orphan.middle_name_ar">
								</div>

								<div class="col-md-3 form-group">
									<label>{{ trans('general.fields.orphan.general.gender') }}</label>
									<select class="form-control" v-model="orphan.gender">
										<option value="0" :selected="orphan.gender == 0">{{ trans('general.gender.male') }}</option>
										<option value="1" :selected="orphan.gender == 1">{{ trans('general.gender.female') }}</option>
									</select>
								</div>

								<div class="col-md-3 form-group">
									<label>{{ trans('general.fields.orphan.general.birthday') }}</label>
									<input type="text" class="form-control"
									v-model="orphan.birthday">
								</div>

								<div class="col-md-12"></div>
								<div class="col-md-6 form-group">
									<div class="photo-upload">

										<img :src="getPhoto()" @click="showPhoto(getPhoto())">

										<div class="photo-tools">
											<div class="btn btn-default upload-photo" 
											v-show="cropper == false"><i class="fa fa-upload"></i></div>

											<div class="btn btn-default delete-photo" @click="removePhoto()" 
											v-show="orphan.photo != 'default.jpg' && cropper == false"><i class="fa fa-times"></i></div>

											<div class="btn btn-default crop" @click="toggleCrop()" 
											v-show="orphan.photo != 'default.jpg' && cropper == false">
											<i class="fa fa-crop"></i></div>

											<div class="btn btn-default cancel-crop"  @click="toggleCrop()"  
											v-show="cropper != false"><i class="fa fa-times"></i></div>

											<div class="btn btn-default submit-crop"  @click="submitCrop()"  
											v-show="cropper != false"><i class="fa fa-check"></i></div>
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>{{ trans('general.fields.orphan.general.video') }}</label>
										<input type="text" class="form-control"
										v-model="orphan.video">
									</div>

									<div class="form-group">
										<label>{{ trans('general.fields.orphan.general.health_state') }}</label>
										<select class="form-control"v-model="orphan.health_state">
											<option value="0" :selected="orphan.health_state == 0">{{ trans('general.health_state.sick') }}</option>
											<option value="1" :selected="orphan.health_state == 1">{{ trans('general.health_state.healthy') }}</option>
										</select>
									</div>

									<div class="form-group">
										<label>{{ trans('general.fields.orphan.general.has_donation') }}</label>
										<input type="checkbox" class="cbx hide" id="has_donation" 
										v-model="orphan.has_donation">
										<label for="has_donation" class="lbl"></label>
									</div>

									<div class="form-group" v-show="orphan.has_donation">
										<label>{{ trans('general.fields.orphan.general.donor_id') }}</label>
										<input type="text" class="form-control"
										v-model="orphan.donor_id">
									</div>
								</div>
							</div>
						</div>

						<!-- Step Two: Information -->
						<div role="tabpanel" class="tab-pane" id="step-two-info">
							<div class="row">
								<div class="col-md-6 form-group">
									<label>{{ trans('general.fields.orphan.general.id') }}</label>
									<input type="text" class="form-control"
									v-model="orphan.id">
								</div>

								<div class="col-md-6 form-group">
									<label>{{ trans('general.fields.orphan.general.phone') }}</label>
									<input type="text" class="form-control"
									v-model="orphan.phone">
								</div>

								<div class="col-md-12 form-group">
									<label>{{ trans('general.fields.orphan.general.email') }}</label>
									<input type="text" class="form-control" v-model="orphan.email">
								</div>

								<div class="col-md-12 form-group">
									<label>{{ trans('general.fields.orphan.general.national_id') }}</label>
									<input type="text" class="form-control" v-model="orphan.national_id">
								</div>

								<div class="col-md-12 form-group">
									<label>{{ trans('general.fields.orphan.general.bank_id') }}</label>
									<input type="text" class="form-control" v-model="orphan.bank_id">
								</div>
							</div>
						</div>

						<!-- Step Three: Family -->
						<div role="tabpanel" class="tab-pane" id="step-three-family">
							<div class="row">
								<div class="col-md-4 form-group">
									<label>{{ trans('general.fields.orphan.family.members') }}</label>
									<input type="text" class="form-control" v-model="orphan.family.family_members">
								</div>

								<div class="col-md-4 form-group">
									<label>{{ trans('general.fields.orphan.family.brothers') }}</label>
									<input type="text" class="form-control" v-model="orphan.family.brothers">
								</div>

								<div class="col-md-4 form-group">
									<label>{{ trans('general.fields.orphan.family.sisters') }}</label>
									<input type="text" class="form-control" v-model="orphan.family.sisters">
								</div>

								<div class="col-md-4 form-group">
									<label>{{ trans('general.fields.orphan.family.no_parents') }}</label>
									<input type="checkbox" class="cbx hide" id="no_parents" 
									v-model="orphan.family.no_parents">
									<label for="no_parents" class="lbl"></label>
								</div>

								<div class="col-md-8 form-group">
									<label>{{ trans('general.fields.orphan.family.parent_death') }}</label>
									<input type="text" class="form-control" v-model="orphan.family.parent_death">
								</div>

								<div class="col-md-6 form-group">
									<label>{{ trans('general.fields.orphan.family.caretaker') }}</label>
									<input type="text" class="form-control" v-model="orphan.family.caretaker_name">
								</div>

								<div class="col-md-6 form-group">
									<label>{{ trans('general.fields.orphan.family.caretaker_relation') }}</label>
									<input type="text" class="form-control" v-model="orphan.family.caretaker_relation">
								</div>
							</div>
						</div>

						<!-- Step Four: Education -->
						<div role="tabpanel" class="tab-pane" id="step-four-education">
							<div class="row">
								<div class="col-md-8 form-group">
									<label>{{ trans('general.fields.orphan.education.level') }}</label>
									<input type="text" class="form-control"
									v-model="orphan.education.level">
								</div>

								<div class="col-md-4 form-group">
									<label>{{ trans('general.fields.orphan.education.class') }}</label>
									<select class="form-control"
									value="@{{ orphan.education.class }}" v-model="orphan.education.class">
									<option value="0" :selected="orphan.education.class == 0">{{ trans('general.education.pre_school') }}</option>
									<option value="1" :selected="orphan.education.class == 1">1</option>
									<option value="2" :selected="orphan.education.class == 2">2</option>
									<option value="3" :selected="orphan.education.class == 3">3</option>
									<option value="4" :selected="orphan.education.class == 4">4</option>
									<option value="5" :selected="orphan.education.class == 5">5</option>
									<option value="6" :selected="orphan.education.class == 6">6</option>
									<option value="7" :selected="orphan.education.class == 7">7</option>
									<option value="8" :selected="orphan.education.class == 8">8</option>
									<option value="9" :selected="orphan.education.class == 9">9</option>
								</select>
							</div>

							<div class="col-md-8 form-group">
								<label>{{ trans('general.fields.orphan.education.grades') }}</label>
								<select class="form-control" v-model="orphan.education.grades">
									<option value="1" :selected="orphan.education.grades == 1">{{ trans('general.education.grades.1') }}</option>
									<option value="2" :selected="orphan.education.grades == 2">{{ trans('general.education.grades.2') }}</option>
									<option value="3" :selected="orphan.education.grades == 3">{{ trans('general.education.grades.3') }}</option>
									<option value="4" :selected="orphan.education.grades == 4">{{ trans('general.education.grades.4') }}</option>
									<option value="5" :selected="orphan.education.grades == 5">{{ trans('general.education.grades.5') }}</option>
								</select>
							</div>

							<div class="col-md-4 form-group">
								<label>{{ trans('general.fields.orphan.education.with_pay') }}</label>
								<input type="checkbox" class="cbx hide" id="with_pay" 
								v-model="orphan.education.with_pay">
								<label for="with_pay" class="lbl"></label>
							</div>
						</div>
					</div>

					<!-- Step Five: Residence -->
					<div role="tabpanel" class="tab-pane" id="step-five-residence">
						<div class="row">
							<div class="col-md-6 form-group">
								<label>{{ trans('general.fields.orphan.residence.country') }}</label>
								<input type="text" class="form-control" v-model="orphan.residence.country">
							</div>

							<div class="col-md-6 form-group">
								<label>{{ trans('general.fields.orphan.residence.city') }}</label>
								<input type="text" class="form-control" v-model="orphan.residence.city">
							</div>

							<div class="col-md-6 form-group">
								<label>{{ trans('general.fields.orphan.residence.village') }}</label>
								<input type="text" class="form-control" v-model="orphan.residence.village">
							</div>

							<div class="col-md-6 form-group">
								<label>{{ trans('general.fields.orphan.residence.property') }}</label>
								<select class="form-control" v-model="orphan.residence.ownership">
									<option value="1" :selected="orphan.residence.ownership == 1">{{ trans('general.residence.personal') }}</option>
									<option value="0" :selected="orphan.residence.ownership == 0">{{ trans('general.residence.with_pay') }}</option>
								</select>
							</div>
						</div>
					</div>

					<!-- Step 5.5: Docs -->
					<div role="tabpanel" class="tab-pane" id="step-docs">
						<div class="row">
							<div class="col-md-12 form-group">
								<label>{{ trans('general.fields.orphan.general.documents') }}</label>
								<div class="docs-upload">
									<div class="btn btn-primary upload-doc"><i class="fa fa-upload"></i> 
										{{ trans('general.actions.upload') }}
									</div>

									<div class="previews row">
										<div class="preview col-md-4" v-for="doc in orphan.documents">
											<div class="preview-container" 
											v-bind:style="{ background: 'url(' + getDocument(doc.name) + ')' }" 
											@click="showGallery(doc.name)"></div>

											<div class="doc-tools">
												<div class="doc-tools-container">
													<div class="btn btn-default remove-doc" @click="removeDocument(doc.name)">
														<i class="fa fa-times"></i>
													</div>

													<a class="btn btn-default download-doc" 
													:href="getDocument(doc.name)" 
													:download="getDocument(doc.name)"><i class="fa fa-download"></i></a>

													<input class="form-control edit-doc" type="text" v-model="doc.description">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Step Six: Note -->
					<div role="tabpanel" class="tab-pane" id="step-six-note">
						<div class="row">
							<div class="col-md-12 form-group">
								<label>{{ trans('general.fields.orphan.general.note') }}</label>
								<textarea class="form-control" v-model="orphan.note" rows="5"></textarea>
							</div>
						</div>
					</div>

					<!-- Financial Reports -->
					<div role="tabpanel" class="tab-pane" id="step-seven-reports">
						<div class="row">

							@include('admin.partials.modals.finances')

						</div>
					</div>


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">
						{{ trans('general.actions.close') }}
					</button>

					<button type="button" class="btn btn-primary" 
					@click="submit">{{ trans('general.actions.save') }}</button>
				</div>
			</div>
		</div>
	</div>

	@include('admin.partials.modals.mass-update')

</div>