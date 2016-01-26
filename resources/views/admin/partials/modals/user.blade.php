<!-- Modal -->
<div id="user">
	<div class="modal fade" id="add-user-modal" tabindex="-1" role="dialog" aria-labelledby="add-user-modal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">{{ trans('general.actions.add-user') }}</h4>
				</div>
				<div class="modal-body">

					<input type="hidden" id="current-user-id" v-model="currentID" value="blank">

					<div class="row">
						<div class="col-md-12 form-group">
							<label>{{ trans('general.fields.user.name') }}</label>
							<input type="text" class="form-control"
							value="@{{ user.name }}" v-model="user.name">
						</div>

						<div class="col-md-12 form-group">
							<label>{{ trans('general.fields.user.username') }}</label>
							<input type="text" class="form-control"
							value="@{{ user.username }}" v-model="user.username">
						</div>

						<div class="col-md-12 form-group">
							<label>{{ trans('general.fields.user.email') }}</label>
							<input type="text" class="form-control"
							value="@{{ user.email }}" v-model="user.email">
						</div>

						<div class="col-md-12 form-group">
							<label>{{ trans('general.fields.user.password') }}</label>
							<input type="password" class="form-control"
							value="@{{ user.password }}" v-model="user.password">
						</div>

						<div class="col-md-4 form-group">
							<label>{{ trans('general.fields.user.language') }}</label>
							<select class="form-control" placeholder="Gjuha" v-model="user.language">
								<option value="al" :selected="user.language == 'al'">{{ trans('general.languages.al') }}</option>
								
								<option value="ar-kw" :selected="user.language == 'ar-kw'">{{ trans('general.languages.ar-kw') }}</option>

								<option value="en" :selected="user.language == 'en'">{{ trans('general.languages.en') }}</option>
							</select>
						</div>

						<div class="col-md-4 form-group">
							<label>{{ trans('general.fields.user.role') }}</label>
							<select class="form-control" placeholder="Gjuha" v-model="user.type">
								<option value="admin" :selected="user.type == 'admin'">{{ trans('general.roles.admin') }}</option>
								<option value="view" :selected="user.type == 'view'">{{ trans('general.roles.viewer') }}</option>
							</select>
						</div>

						<div class="col-md-4 form-group">
							<label>{{ trans('general.fields.user.active') }}</label>
							<input type="checkbox" class="cbx hide" id="active" 
							v-model="user.active">
							<label for="active" class="lbl"></label>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('general.actions.close') }}</button>
					<button type="button" class="btn btn-primary" 
					@click="submit">{{ trans('general.actions.save') }}</button>
				</div>
			</div>
		</div>
	</div>
</div>