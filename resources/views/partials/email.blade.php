<div id="email">
	<div class="modal fade in" id="send-email-modal" aria-labelledby="send-email-modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel"></h4>
				</div>
				<div class="modal-body">
					<div class="form-group" v-show="hasField('to')">
						<label>{{ trans('general.email.email') }}</label>
						<input type="text" v-model="to" class="form-control">
					</div>

					<div class="form-group" v-show="hasField('subject')">
						<label>{{ trans('general.email.subject') }}</label>
						<input type="text" v-model="subject" class="form-control">
					</div>

					<div class="form-group" v-show="hasField('message')">
						<label>{{ trans('general.email.message') }}</label>
						<textarea v-model="message" class="form-control" rows="5"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('general.actions.close') }}</button>
					<button type="button" class="btn btn-primary" @click="send()">{{ trans('general.actions.send') }}</button>
				</div>
			</div>
		</div>
	</div>
</div>