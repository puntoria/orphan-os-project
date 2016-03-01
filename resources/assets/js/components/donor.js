/**********************************************************************
    DONOR - VUE INSTANCE
**********************************************************************/
var Donor = new Vue({
    el: "#donor",

    data: {
        // Default values for an Orphan
        default: {
            id: '',
            name: '',
            email: '',
            password: '',
            language: 'al',
            active: 0
        },

        donor: {},

        /* The ID of the current Donor. 
           If a new donor is being added, it's set to 'new' */
        currentID: ''
    },

    ready: function() {
        this.defaults();
    },

    methods: {
        show: function() {
            this.get(this.currentID, function(donor) {
                this.donor = donor;
                this.showForm();
            }.bind(this));
        },

        get: function(id, _callback) {
            this.$http.get('donors/' + id, function(data, status, request) {
                _callback(data.data);
            });
        },

        new: function() {
            this.defaults();
            this.showForm();
        },

        create: function() {
            this.$http.post('donors/create', {data: this.donor}, function(data, status, request) {

                Donors.refresh();
                this.currentID = this.donor.id;
                Dialog.make(TRANSLATIONS.request.success, data.data.message, 2000);

            }).error(function(data) {
                var errors = this.getErrors(data);

                Dialog.make(TRANSLATIONS.request["submission-problems"], errors.join(', '), 2000);
            }.bind(this));;
        },

        update: function() {
            this.$http.post('donors/' + this.currentID + '/update', {data: this.donor}, function(data, status, request) {

                if (data.data.updated_id != null) {
                    this.currentID = data.data.updated_id;
                };

                Donors.refresh();
                Dialog.make(TRANSLATIONS.request.success, data.data.message, 2000);
                
            }).error(function(data) {
                var errors = this.getErrors(data);

                Dialog.make(TRANSLATIONS.request["submission-problems"], errors.join(', '), 2000);
            }.bind(this));
        },

        delete: function(id) {
            this.$http.post('donors/' + id + '/delete', {}, function(data, status, request) {
                Donors.refresh();
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
            $('#donor #add-donor-modal').modal(); 
        },

        defaults: function() { 
            this.donor = $.extend(true, {}, this.default); 
        },

        submitMassDelete: function() {
            this.$http.post(Helpers.API('donors/delete'), {donors: Donors.selected}, function(data, status, request) {
                Donors.refresh();
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