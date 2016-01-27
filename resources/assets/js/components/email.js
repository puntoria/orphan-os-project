/**********************************************************************
    EMAIL - VUE INSTANCE
**********************************************************************/
var Email = new Vue({
    el: "#email",

    data: {
        node: $("#email"),
        modal: $("#send-email-modal"),

        fields: ['subject', 'message'],

        to: 'albion.selimaj.4@gmail.com',
        subject: '',
        message: '',
    },

    created: function() {

    },

    methods: {
        show: function() {
            this.modal.modal('show');
        },

        hide: function() {
            this.modal.modal('hide');
        },

        make: function(fields, reset) {
            if(reset) this.reset();
            
            this.fields = (typeof fields === 'undefined') ? ['subject', 'message'] : fields;

            this.show();
        },

        send: function() {
            data = {
                to: this.to,
                subject: this.subject,
                message: this.message,
            };

            this.$http.post('email', data, function(data, status, request) {

                Dialog.make(TRANSLATIONS.request.success, data.data.message, 2000);

            }).error(function(data) {
                var errors = this.getErrors(data);

                Dialog.make(TRANSLATIONS.request["submission-problems"], errors.join(', '), 2000);
            }.bind(this));
        },

        hasField: function(field) {
            return Helpers.inArray(field, this.fields);
        },

        reset: function() {
            this.subject = '';
            this.message = '';
        },

        getErrors: function(data) { 
            var errors = []; 
            for (var error in data) { errors.push(data[error]); };

            return errors;
        },
    }
});

$("#send-normal-email").click(function(e) {
    e.preventDefault();

    Email.make(undefined, true);
});

$("body").on('click', '.send-orphan-request-email', function(e) {
    e.preventDefault();

    var orphanID   = parseInt( $(this).data('orphan-id') );
    var orphanName = $(this).data('orphan-name');

    Email.subject = TRANSLATIONS.request['donate-email'].subject;
    Email.message = TRANSLATIONS.request['donate-email'].message + orphanName + " (" + orphanID + ").";
    Email.make(['message']);
});