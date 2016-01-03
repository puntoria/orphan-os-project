// SCRIPTS
Vue.http.options.root = API_URL;
Vue.http.headers.common['X-CSRF-TOKEN'] = TOKEN;

/**********************************************************************
    MAIN VUE INSTANCE
**********************************************************************/
var Main = new Vue({
	el: '#app',

	data: {
		// Orphans List
		orphans: '',
		showing: 'data',

		// Search Query for the table
		search: '',

		// The Table Element - jQuery
		table: $("#orphans-list"),

		// The Table Element - Datatables
		datatable: '',

		// Table Columns
		columns: [
		{ data: 'id' },
		{ data: 'donor' },
		{ data: 'donation' },
		{ data: 'first_name' },
		{ data: 'middle_name' },
		{ data: 'last_name' },
		{ data: 'city' },
		{ data: 'video' },
		{ data: 'info.options' }
		],

		// Possible Table Lengths and Rows per page
		possibleLengths: [10, 25, 50, 100, 250, 500, 1000],
		pageLength: 10,

		// Language Translations
		oLanguage: {
			"oPaginate": {
                "sPrevious": "&laquo;", // This is the link to the previous page
                "sNext": "&raquo;", // This is the link to the next page
            }
        },

        // Selected Rows
        selected: []
    },

    created: function() {
    	var app = this;

    	app.getOrphansList(function() {
    		app.fillTable(app.orphans.data);
    	});
    },

    methods: {
    	getOrphansList: function(_callback) {
            this.$http.get('orphans', function(data, status, request) {
                this.orphans = data;

                this.orphans.withDonation = this.orphans.data.filter(function(obj) {
                    return obj.donation == 1;
                });

                this.orphans.withoutDonation = this.orphans.data.filter(function(obj) {
                    return obj.donation == 0;
                });

                _callback(this);
            }.bind(this));
    	},

    	fillTable: function(data) {
    		this.datatable = this.table.DataTable( {
    			data: data,
    			oLanguage: this.oLanguage,
    			columns: this.columns
    		} );
    	},

    	filter: function(data) {
    		this.datatable.clear()
    					  .rows.add(this.orphans[data])
    					  .draw();
    		this.showing = data;
    	},

        refresh: function() {
            this.getOrphansList(function() {
                this.filter(this.showing);
            }.bind(this));
        }
    },
});

/**********************************************************************
    ORPHAN - VUE INSTANCE
**********************************************************************/
var Orphan = new Vue({
    el: "#orphan",

    data: {
        // Default values for an Orphan
        default: {
            /* First Page */
            first_name: '',
            first_name_ar: '',

            middle_name: '',
            middle_name_ar: '',

            last_name: '',
            last_name_ar: '',

            photo: 'default.jpg',
            gender: 1,
            birthday: '2001-01-21',
            video: '',
            health_state: 1,

            has_donation: 1,
            donor_id: '',
            
            /* Second Page */
            id: '',
            phone: '',
            email: '',
            national_id: '',
            bank_id: '',

            /* Third Page */
            family: {
                family_members: '',
                brothers: '',
                sisters: '',

                no_parents: 0,
                parent_death: '',

                caretaker_name: '',
                caretaker_relation: ''
            },

            /* Fourth Page */
            education: {
                level: '',
                class: "0",
                grades: 5,
                with_pay: 1
            },

            /* Fifth Page */
            residence: {
                country: '',
                city: '',
                village: '',
                ownership: 1
            },

            /* Sixth Page */
            note: ''
        },

        orphan: {},

        massUpdateFields: {
            general: {
                gender: 1,
                health_state: 1,
                has_donation: 1
            },

            family: {
                no_parents: 0
            },

            education: {
                level: '',
                class: "0",
                grades: 5,
                with_pay: 1
            },

            residence: {
                country: '',
                city: '',
                village: '',
                ownership: 1
            }
        },

        massUpdateField: {
            category: 'general',
            field: 'gender'
        },

        /* The ID of the current Orphan. 
           If a new orphan is being added, it's set to 'new' */
        currentID: '',

        // See if photo is in crop mode and return the cropper instance
        cropper: false,

        // The dropzone instance
        dropzone: false,
    },

    created: function() {
        this.defaults();

        this.initDropzone();
    },

    methods: {
        show: function() {
            this.get(this.currentID, function(orphan) {
                this.orphan = orphan;
                this.showForm();
            }.bind(this));
        },

        get: function(id, _callback) {
            this.$http.get('orphans/' + id, function(data, status, request) {
                _callback(data.data);
            });
        },

        new: function() {
            this.defaults();
            this.showForm();
        },


        create: function() {
            this.$http.post('orphans/create', {data: this.orphan}, function(data, status, request) {

                Main.refresh();
                Dialog.make('Success', data.data.message, 2000);

            }).error(function(data) {
                var errors = this.getErrors(data);

                Dialog.make('There were problems with your submission', errors.join(', '), 2000);
            }.bind(this));;
        },

        update: function() {
            this.$http.post('orphans/' + this.currentID + '/update', {data: this.orphan}, function(data, status, request) {

                if (data.data.updated_id != null) {
                    this.currentID = data.data.updated_id;
                };

                Main.refresh();
                Dialog.make('Success', data.data.message, 2000);
                
            }).error(function(data) {
                var errors = this.getErrors(data);

                Dialog.make('There were problems with your submission', errors.join(', '), 2000);
            }.bind(this));
        },

        getErrors: function(data) { 
            var errors = []; 
            for (var error in data) { errors.push(data[error]); };

            return errors;
        },

        initDropzone: function() {
            this.dropzone = new Dropzone(".photo-upload", { 
                url: Helpers.API('orphans/photo'),
                maxFilesize: 4,
                uploadMultiple: false,
                paramName: 'photo',
                createImageThumbnails: false,
                addRemoveLinks: false,
                clickable: '.upload-photo',

                sending: function(event, xhr, formData) {
                    formData.append('_token', TOKEN);
                },

                success: function(event, response) {
                    Orphan.orphan.photo = response.data.photo;
                    this.removeAllFiles();
                },

                addedfile: function(file) {
                    // TODO: Use Cropper JS to resize photo
                    console.log('Dropzone: File Added');
                }
            });
        },

        removePhoto: function() {
            if (this.orphan.photo == 'default.jpg') return false;

            this.$http.post('photo/' + this.orphan.photo + '/delete', {}, function(data, status, request) {
                this.orphan.photo = 'default.jpg';
                Dialog.make('Success', data.data.message, 2000);
            }).error(function(data) {
                Dialog.make('Error', data.data.message, 2000);
            }.bind(this));
        },

        initCropper: function() {
            $('.photo-upload > img').cropper({
                aspectRatio: 3 / 4,
                autoCropArea: 0.65,
                strict: true,
                guides: true,
                highlight: true,
                dragCrop: false,
                cropBoxMovable: true,
                cropBoxResizable: true
            });

            this.cropper = $('.photo-upload img');
        },

        toggleCrop: function() {
            if (this.cropper != false) {
                this.cropper.cropper('destroy');
                this.cropper = false;
            } else {
                this.initCropper();
            };
        },

        submitCrop: function() {
            canvas = this.cropper.cropper('getCroppedCanvas');
            croppedPhoto = Helpers.dataURItoBlob(canvas.toDataURL());
            croppedPhoto.name = "cropped-" + this.orphan.photo;
            this.dropzone.addFile(croppedPhoto);
            this.toggleCrop();
        },

        submit: function() { 
            this.currentID == 'new' ? this.create() : this.update(); 
        },

        getPhoto: function() { 
            return STORAGE + "/photos/" + this.orphan.photo 
        },

        showForm: function() { 
            $('#orphan #add-orphan-modal').modal(); 
        },

        defaults: function() { 
            this.orphan = $.extend(true, {}, this.default); 
        },

        showMassUpdate: function() { 
            $('#orphan #mass-update-modal').modal(); 
        },

        setMassUpdateField: function(field, category) {
            this.massUpdateField.field = field;
            this.massUpdateField.category = category;
        },

        submitMassUpdate: function() {
            if (this.massUpdateFields[this.massUpdateField.category][this.massUpdateField.field] === undefined) {
                return false;
            };

            var data = {
                category: this.massUpdateField.category,
                field: this.massUpdateField.field,
                value: this.massUpdateFields[this.massUpdateField.category][this.massUpdateField.field],
                orphans: Main.selected
            };

            this.$http.post(Helpers.API('orphans/update'), data, function(data, status, request) {
                Dialog.make('Success', data.data.message, 2000);
            });
        },
    },

    watch: {
        currentID: function() {
            if (this.currentID == 'blank') return;
            if (this.currentID == 'new')   return this.new();

            this.show();
        }
    }
});

/**********************************************************************
    DIALOG - VUE INSTANCE
**********************************************************************/
var Dialog = new Vue({
    el: "#dialog",

    data: {
        node: $("#dialog"),
        title: 'Dialog Title',
        content: 'Dialog Content'
    },

    created: function() {
        this.hide();
    },

    methods: {
        show: function(seconds) {
            this.node.show();

            setTimeout(function() {
                this.hide();
            }.bind(this), seconds);
        },

        hide: function() {
            this.node.hide();
        },

        make: function(title, content, seconds) {
            this.title = title;
            this.content = content;

            this.show(seconds);
        }
    }
});

/**********************************************************************
    JQUERY
**********************************************************************/
$('body').on('click', '.select-row', function(e) {
    var self = $(this);
    var orphanID = parseInt( self.text() );

    if (Helpers.inArray(orphanID, Main.selected)) {
        Main.selected.splice(Main.selected.indexOf(orphanID), 1);
        self.closest('tr').removeClass('selected');
        return;
    }

    Main.selected.push(orphanID);
    self.closest('tr').addClass('selected');
});

$('body').on('click', '.row-dropdown .change', function(e) {
    var orphanID = parseInt( $(this).closest('ul.row-dropdown').data('orphan-id') );

    Orphan.currentID = orphanID;
    Orphan.show();
});

$('body').on('click', '.add-new-orphan-toggle', function(e) {
    Orphan.currentID = 'new';
    Orphan.new();
});

$('body').on('click', '.mass-update-orphans-toggle', function(e) {
    Orphan.showMassUpdate();
});