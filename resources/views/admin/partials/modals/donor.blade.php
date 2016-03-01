<!-- Modal -->
<div id="donor">
	<div class="modal fade" id="add-donor-modal" tabindex="-1" role="dialog" aria-labelledby="add-donor-modal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"> {{ trans('general.actions.add-donor') }}</h4>
				</div>
				<div class="modal-body">

					<input type="hidden" id="current-donor-id" v-model="currentID" value="blank">

					<div class="row">
						<div class="col-md-12 form-group">
							<label>{{ trans('general.fields.donor.id') }}</label>
							<input type="text" class="form-control" 
							value="@{{ donor.id }}" v-model="donor.id">
						</div>

						<div class="col-md-12 form-group">
							<label>{{ trans('general.fields.donor.name') }}</label>
							<input type="text" class="form-control"
							value="@{{ donor.name }}" v-model="donor.name">
						</div>

						<div class="col-md-12 form-group">
							<label>{{ trans('general.fields.donor.email') }}</label>
							<input type="text" class="form-control"
							value="@{{ donor.email }}" v-model="donor.email">
						</div>

						<div class="col-md-12 form-group">
							<label>{{ trans('general.fields.donor.password') }}</label>
							<input type="password" class="form-control"
							value="@{{ donor.password }}" v-model="donor.password">
						</div>

						<div class="col-md-6 form-group">
							<label>{{ trans('general.fields.donor.language') }}</label>
							<select class="form-control" v-model="donor.language">
								<option value="al" :selected="donor.language == 'al'">
									{{ trans('general.languages.al') }}
								</option>

								<option value="ar-kw" :selected="donor.language == 'ar-kw'">
									{{ trans('general.languages.ar-kw') }}
								</option>

								<option value="en" :selected="donor.language == 'en'">
									{{ trans('general.languages.en') }}
								</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
							<label>{{ trans('general.fields.donor.active') }}</label>
							<input type="checkbox" class="cbx hide" id="active" 
							v-model="donor.active">
							<label for="active" class="lbl"></label>
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
</div>