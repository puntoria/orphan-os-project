/* SCRIPTS */

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
    		$.getJSON(Helpers.API('orphans'), function(data) {
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

        edit: function() {
            console.log('show edit');
        }
    },
});

/**********************************************************************
    ORPHAN - VUE INSTANCE
**********************************************************************/
var Orphan = new Vue({
    el: "#orphan",

    data: {
        orphan: {
            /* First Page */
            first_name: '',
            first_name_ar: '',

            middle_name: '',
            middle_name_ar: '',

            last_name: '',
            last_name_ar: '',

            photo: '',
            gender: 1,
            birthday: '2001-02-20',
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
                grades: 4,
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
            note: 'asdf'
        },

        /* The ID of the current Orphan. 
           If a new orphan is being added, it's set to 'new' */
        currentID: 'new'
    },

    created: function() {
        // this.id = $("#orphan").data("orphan-id");

        // console.log(this.id);
    },

    methods: {
        setup: function() {
            $.getJSON(Helpers.API('orphans/' + this.currentID), function(data) {
                this.orphan = data.data;
                this.showForm();
            }.bind(this));
        },

        update: function() {
            console.log(JSON.stringify(this.orphan));
        },

        showForm: function() {
            $('#orphan .modal').modal();
        }
    },

    watch: {
        currentID: function() {
            this.setup();
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
});