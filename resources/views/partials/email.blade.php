<div id="email">
	<div class="modal fade in" id="send-email-modal" aria-labelledby="send-email-modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel">Send Email</h4>
				</div>
				<div class="modal-body">
					<div class="form-group" v-show="hasField('to')">
						<input type="text" v-model="to" placeholder="Email" class="form-control">
					</div>

					<div class="form-group" v-show="hasField('subject')">
						<input type="text" v-model="subject" class="form-control" placeholder="Subjekti">
					</div>

					<div class="form-group" v-show="hasField('message')">
						<textarea v-model="message" class="form-control" placeholder="Mesazhi" rows="5"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" @click="send()">Send</button>
				</div>
			</div>
		</div>
	</div>
</div>