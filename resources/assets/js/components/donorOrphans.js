/**********************************************************************
    DONOR ORPHANS VUE INSTANCE (Orphan Table)
**********************************************************************/
var DonorOrphans = new Vue({
	el: '#donor-orphans',

	data: {
		showing: 'withDonation',

		// Search Query for the table
		search: '',

		// The Table Element - jQuery
		table: $("#donor-orphans-list"),

		// The Table Element - Datatables
		datatable: '',

		// Table Columns
		columns: [
		{ data: 'orphans.id' },
		{ data: 'orphans.first_name' },
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

        donorID: null,

        // Selected Rows
        selected: [],

        stats: {
            totalCount: 0,
            withDonationCount: 0,
            withoutDonationCount: 0,
        }
    },

    ready: function() {
    	this.fillTable();
        this.getStats();
    },

    methods: {
    	fillTable: function(data) {
    		var app = this;

            this.datatable = this.table.DataTable({
                oLanguage: this.oLanguage,
                columns: this.columns,
                "processing": true,
                "serverSide": true,
                "ajax": Helpers.API('donors/' + app.donorID + '/orphans/get/' + app.showing),
            
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

    	filter: function(data) {
    		this.showing = data;
            this.datatable.ajax.url(Helpers.API('donors/' + this.donorID + '/orphans/get/' + this.showing));
            this.refresh();
    	},

        refresh: function() {
            this.datatable.ajax.reload(null, false);
            this.getStats();
        },

        getStats: function() {
            this.$http.get(Helpers.API('donors/' + this.donorID + '/orphans/stats'), {}, function(stats) {
                this.stats = stats.data;
            }.bind(this));
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