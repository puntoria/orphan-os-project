/* SCRIPTS */

/*
 * Main Vue Instance which handles table data
 */
new Vue({
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
        }
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
    	}
    }	
});

new Vue({
    el: "#orphan",

    data: {
        id: false
    },

    created: function() {
        // this.id = $("#orphan").data("orphan-id");

        // console.log(this.id);
    },

    methods: {
        setup: function() {
            
        }
    }
});