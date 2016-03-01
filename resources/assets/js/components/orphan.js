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
            birthday: '',
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

            documents: [],

            finances: [],

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

        financesYear: false,

        newFinanceYear: '',

        lang: 'ar',
    },

    ready: function() {
        this.defaults();

        this.initDropzone();
        this.initDocsDropzone();
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
                this.currentID = this.orphan.id;
                Dialog.make(TRANSLATIONS.request.success, data.data.message, 2000);

            }).error(function(data) {
                var errors = this.getErrors(data);

                Dialog.make(TRANSLATIONS.request['submission-problems'], errors.join(', '), 2000);
            }.bind(this));
        },

        update: function() {
            this.$http.post('orphans/' + this.currentID + '/update', {data: this.orphan}, function(data, status, request) {

                if (data.data.updated_id != null) {
                    this.currentID = data.data.updated_id;
                };

                Main.refresh();
                Dialog.make(TRANSLATIONS.request.success, data.data.message, 2000);
                
            }).error(function(data) {
                var errors = this.getErrors(data);

                Dialog.make(TRANSLATIONS.request['submission-problems'], errors.join(', '), 2000);
            }.bind(this));
        },

        delete: function(id) {
            this.$http.post('orphans/' + id + '/delete', {}, function(data, status, request) {
                Main.refresh();
                Dialog.make(TRANSLATIONS.request.success, data.data.message, 2000);
            });
        },

        getFinances: function(year) {
            if (year == false) return {};

            var list = this.orphan.finances.list;

            var yearly = [];

            Helpers.loopObject(function(key, list) {
                if (list[key].year == year) {
                    var yearlyFinance = list[key];
                    yearlyFinance.finance_array_id = key;

                    yearly.push(yearlyFinance);
                }
            }, list);

            return yearly;
        },

        addFinances: function() {
            var parsedYear = parseInt(this.newFinanceYear);
            if (Helpers.inArray(this.newFinanceYear, this.orphan.finances.years) ||
                Helpers.inArray(parsedYear, this.orphan.finances.years)) {
                this.financesYear   = this.newFinanceYear;
                this.newFinanceYear = '';
                return false;
            };

            for (var i = 0; i <= 11; i++) {
                var finance = {
                    id: 'new',
                    year: this.newFinanceYear,
                    month: i,
                    has_donation: false,
                    amount_euro: 0,
                    amount_dinar: 0,
                    type: '',
                    received_at: '',
                };

                this.orphan.finances.list.push(finance);
            }

            this.orphan.finances.years.push(this.newFinanceYear);
            this.financesYear = this.newFinanceYear;
        },

        deleteFinances: function(year) {
            this.$http.post('orphans/' + this.currentID + '/finances/' + year + '/delete', {}, function(data, status, request) {

                this.orphan.finances.list = this.orphan.finances.list.filter(function(obj) {
                    return obj.year != year;
                });

                this.orphan.finances.years.splice(this.orphan.finances.years.indexOf(year), 1);

                this.financesYear = false;

                Dialog.make(TRANSLATIONS.request.success, data.data.message, 2000);
            }.bind(this));
        },

        confirmDeleteFinances: function(year) {
            Dialog.confirm(TRANSLATIONS.request["delete-report"], TRANSLATIONS.request.confirms["report-delete"], function(response) {
                if (response === true) {
                    Orphan.deleteFinances(year);
                };
            });
        },

        getMonth: function(index) {
            return Helpers.getMonth(index);
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

                error: function(event, response) {
                    Dialog.make(TRANSLATIONS.request.error, response.data.message, 2000);
                },

                addedfile: function(file) {
                    //
                }
            });
        },

        initDocsDropzone: function() {
            var self = this;

            new Dropzone(".docs-upload", { 
                url: Helpers.API('orphans/document'),
                maxFilesize: 4,
                uploadMultiple: false,
                paramName: 'doc',
                clickable: '.upload-doc',

                sending: function(event, xhr, formData) {
                    formData.append('_token', TOKEN);
                },

                success: function(event, response) {
                    this.removeAllFiles();
                    
                    self.orphan.documents.push({
                        name: response.data.doc,
                        description: ''
                    });
                },

                addedfile: function(file) {
                    //
                }
            });
        },

        removePhoto: function() {
            if (this.orphan.photo == 'default.jpg') return false;

            this.$http.post('photo/' + this.orphan.photo + '/delete', {}, function(data, status, request) {
                this.orphan.photo = 'default.jpg';
                Dialog.make(TRANSLATIONS.request.success, data.data.message, 2000);
            }).error(function(data) {
                Dialog.make(TRANSLATIONS.request.error, data.data.message, 2000);
            }.bind(this));
        },

        removeDocument: function(doc) {
            var doc = doc;
            this.$http.post('document/' + doc + '/delete', {}, function(data, status, request) {
                this.orphan.documents = this.orphan.documents.filter(function(el) {
                    return el.name != doc;
                });
                Dialog.make(TRANSLATIONS.request.success, data.data.message, 2000);
            }).error(function(data) {
                Dialog.make(TRANSLATIONS.request.error, data.data.message, 2000);
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

        showGallery: function(doc) {
            var photos = [];
            var currentIndex = false;

            for(i in this.orphan.documents) {
                if (this.orphan.documents[i].name == doc) currentIndex = i;

                photos.push({
                    'name': this.getDocument(this.orphan.documents[i].name),
                    'description': this.orphan.documents[i].description
                });
            };

            Gallery.make(photos, currentIndex);
        },

        showPhoto: function(photo) {
            Gallery.make([{
                'name': photo,
                'description': ''
            }], 0);
        },

        submit: function() { 
            this.currentID == 'new' ? this.create() : this.update(); 
        },

        getPhoto: function() { 
            return STORAGE + "/photos/" + this.orphan.photo 
        },

        getDocument: function(doc) {
            return STORAGE + "/docs/" + doc;
        },

        showForm: function() { 
            $('#orphan #add-orphan-modal').modal(); 
        },

        hideForm: function() {
            $('#orphan #add-orphan-modal').modal('hide'); 
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
                Main.refresh();
                Dialog.make(TRANSLATIONS.request.success, data.data.message, 2000);
            });
        },

        submitMassDelete: function() {
            this.$http.post(Helpers.API('orphans/delete'), {orphans: Main.selected}, function(data, status, request) {
                Main.refresh();
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