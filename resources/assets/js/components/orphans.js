/**********************************************************************
    MAIN VUE INSTANCE (Orphan Table)
**********************************************************************/
var Main = new Vue({
	el: '#orphans',

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

    ready: function() {
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
    			columns: this.columns,

                "fnRowCallback": function( row, data) {
                    if(Helpers.inArray(data.info.id, Main.selected)) {
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
$('body').on('click', '#orphans-list .select-row', function(e) {
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

$('body').on('click', '#orphans .table-row-settings .change', function(e) {
    var orphanID = parseInt( $(this).closest('ul.table-row-settings').data('orphan-id') );

    Orphan.currentID = orphanID;
    Orphan.show();
});

$('body').on('click', '#orphans .table-row-settings .delete', function(e) {
    var orphanID = parseInt( $(this).closest('ul.table-row-settings').data('orphan-id') );

    Dialog.confirm('Delete Orphan', 'Are you sure you want to delete this orphan from the database?', function(response) {
        if (response === true) {
            Orphan.delete(orphanID);
        };
    });
});

$('body').on('click', '.add-new-orphan-toggle', function(e) {
    Orphan.currentID = 'new';
    Orphan.new();
});

$('body').on('click', '.mass-update-orphans-toggle', function(e) {
    Orphan.showMassUpdate();
});

$('body').on('click', '.mass-delete-orphans-toggle', function(e) {
    Dialog.confirm('Delete Orphans', 'Are you sure you want to delete these orphans from the database?', function(response) {
        if (response === true) {
            Orphan.submitMassDelete();
            Main.selected = [];
        };
    });
});