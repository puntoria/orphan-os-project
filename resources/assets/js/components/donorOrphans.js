/**********************************************************************
    DONOR ORPHANS VUE INSTANCE (Orphan Table)
**********************************************************************/
var DonorOrphans = new Vue({
	el: '#donor-orphans',

	data: {
		// Orphans List
		orphans: '',
		showing: 'data',

		// Search Query for the table
		search: '',

		// The Table Element - jQuery
		table: $("#donor-orphans-list"),

		// The Table Element - Datatables
		datatable: '',

		// Table Columns
		columns: [
		{ data: 'id' },
		{ data: 'first_name' },
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

        donorID: null,

        // Selected Rows
        selected: []
    },

    ready: function() {
    	var app = this;

    	app.getOrphansList(function() {
    		app.fillTable(app.orphans.data);
            app.filter('withDonation');
    	});
    },

    methods: {
    	getOrphansList: function(_callback) {
            this.$http.get('donors/' + this.donorID + '/orphans', function(data, status, request) {
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
    			columns: this.columns,

                "fnRowCallback": function( row, data) {
                    if(Helpers.inArray(data.info.id, DonorOrphans.selected)) {
                        $(row).addClass('selected');
                    };
                }
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
        },

        selectAll: function(e, self) {
            e.preventDefault();

            if(this.selected.length > 0) {
                this.selected = [];
                $('.select-row').closest('tr').removeClass('selected')
            } else {
                $('.select-row').click();  
            }
        }
    },
});

/************************************
    Orphans JQUERY
*************************************/ 
$('body').on('click', '#donor-orphans-list .select-row', function(e) {
    var self = $(this);
    var orphanID = parseInt( self.text() );

    if (Helpers.inArray(orphanID, DonorOrphans.selected)) {
        DonorOrphans.selected.splice(DonorOrphans.selected.indexOf(orphanID), 1);
        self.closest('tr').removeClass('selected');
        return;
    }

    DonorOrphans.selected.push(orphanID);
    self.closest('tr').addClass('selected');
});