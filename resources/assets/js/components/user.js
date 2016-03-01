/**********************************************************************
    USER - VUE INSTANCE
**********************************************************************/
var User = new Vue({
    el: "#user",

    data: {
        // Default values for an Orphan
        default: {
            id: '',
            name: '',
            type: 'view',
            email: '',
            active: 0,
            password: '',
            username: '',
            language: 'al'
        },

        user: {},

        /* The ID of the current User. 
           If a new user is being added, it's set to 'new' */
        currentID: ''
    },

    ready: function() {
        this.defaults();
    },

    methods: {
        show: function() {
            this.get(this.currentID, function(user) {
                this.user = user;
                this.showForm();
            }.bind(this));
        },

        get: function(id, _callback) {
            this.$http.get('users/' + id, function(data, status, request) {
                _callback(data.data);
            });
        },

        new: function() {
            this.defaults();
            this.showForm();
        },

        create: function() {
            this.$http.post('users/create', {data: this.user}, function(data, status, request) {

                Users.refresh();
                this.currentID = data.data.id;
                Dialog.make(TRANSLATIONS.request.success, data.data.message, 2000);

            }).error(function(data) {
                var errors = this.getErrors(data);

                Dialog.make(TRANSLATIONS.request["submisison-problems"], errors.join(', '), 2000);
            }.bind(this));
        },

        update: function() {
            this.$http.post('users/' + this.currentID + '/update', {data: this.user}, function(data, status, request) {

                Users.refresh();
                Dialog.make(TRANSLATIONS.request.success, data.data.message, 2000);
                
            }).error(function(data) {
                var errors = this.getErrors(data);

                Dialog.make(TRANSLATIONS.request["submission-problems"], errors.join(', '), 2000);
            }.bind(this));
        },

        delete: function(id) {
            this.$http.post('users/' + id + '/delete', {}, function(data, status, request) {
                Users.refresh();
                Dialog.make(TRANSLATIONS.request.success, data.data.message, 2000);
            });
        },

        getErrors: function(data) {
            var errors = []; 
            for (var error in data) { errors.push(data[error]); };

            return errors;
        },

        submit: function() { 
            this.currentID == 'new' ? this.create() : this.update(); 
        },

        showForm: function() { 
            $('#user #add-user-modal').modal(); 
        },

        defaults: function() { 
            this.user = $.extend(true, {}, this.default); 
        },

        submitMassDelete: function() {
            this.$http.post(Helpers.API('users/delete'), {users: Users.selected}, function(data, status, request) {
                Users.refresh();
                Dialog.make(TRANSLATIONS.request.success, data.data.message, 2000);
            });
        }
    },

    watch: {
        currentID: function() {
            if (this.currentID == 'blank') return;
            if (this.currentID == 'new')   return this.new();

            this.show();
        }
    }
});