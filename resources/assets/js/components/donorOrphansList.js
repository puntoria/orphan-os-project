/**********************************************************************
    DONOR ORPHANS VUE INSTANCE (Orphan Table)
**********************************************************************/
var DonorOrphansList = new Vue({
	el: '#donor-orphans-list',

	data: {
		// Search Query for the table
		search: '',

		// The Table Element - jQuery
		table: $("#donor-full-orphans-list"),

		// The Table Element - Datatables
		datatable: '',

		// Table Columns
		columns: [
		{ data: 'orphans.id' },
        { data: 'orphans.first_name' },
		{ data: 'orphans.middle_name' },
		{ data: 'orphans.last_name' },
		{ data: 'residence.city', 'orderable': false, 'searchable': false },
		{ data: 'video', 'orderable': false, 'searchable': false },
		{ data: 'info.options', 'orderable': false, 'searchable': false }
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
        selected: [],
    },

    ready: function() {
    	this.fillTable();
    },

    methods: {
    	fillTable: function(data) {
    		var app = this;

            this.datatable = this.table.DataTable({
                oLanguage: this.oLanguage,
                columns: this.columns,
                "processing": true,
                "serverSide": true,
                "ajax": Helpers.API('donors/' + app.donorID + '/orphans/withoutDonation'),
            
                "fnRowCallback": function( row, data) {
                    if(Helpers.inArray(data.info.id, app.selected)) {
                        $(row).addClass('selected');
                    };
                }
            });

            this.datatable.on('processing', function(e, settings, processing) {
                Loading.play();
            });
    	},

        refresh: function() {
            this.datatable.ajax.reload(null, false);
            this.getStats();
        },

        downloadPdf: function() {
            window.location.href = Helpers.API('orphans/pdf') + "?orphans=" + JSON.stringify(this.selected);
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
$('body').on('click', '#donor-full-orphans-list .select-row', function(e) {
    var self = $(this);
    var orphanID = parseInt( self.text() );

    if (Helpers.inArray(orphanID, DonorOrphansList.selected)) {
        DonorOrphansList.selected.splice(DonorOrphansList.selected.indexOf(orphanID), 1);
        self.closest('tr').removeClass('selected');
        return;
    }

    DonorOrphansList.selected.push(orphanID);
    self.closest('tr').addClass('selected');
});