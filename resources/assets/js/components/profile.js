/**********************************************************************
    PROFILE - VUE INSTANCE
**********************************************************************/
var Profile = new Vue({
    el: "#profile",

    data: {
        // Default values for an Orphan
        default: {
            name: '',
            email: '',
            username: '',
            language: 'al',
            password: '',
            password_confirmation: ''
        },

        userID: null,
        user: {},
    },

    ready: function() {
        this.get(function(data) {
            this.user = data;
        }.bind(this));
    },

    methods: {
        get: function(_callback) {
            this.$http.get('users/' + this.userID, function(data, status, request) {
                _callback(data.data);
            });
        },

        update: function() {
            this.$http.post('users/' + this.userID + '/update/me', {data: this.user}, function(data, status, request) {

                Dialog.make(TRANSLATIONS.request.success, data.data.message, 2000);
                
            }).error(function(data) {
                var errors = this.getErrors(data);

                Dialog.make(TRANSLATIONS.request["submission-problems"], errors.join(', '), 2000);
            }.bind(this));
        },

        getErrors: function(data) {
            var errors = []; 
            for (var error in data) { errors.push(data[error]); };

            return errors;
        }
    }
});