/**********************************************************************
    MAIN VUE INSTANCE (Orphan Table)
**********************************************************************/
var Main = new Vue({
	el: '#orphans',

	data: {
		showing: 'data',

		// Search Query for the table
		search: '',

		// The Table Element - jQuery
		table: $("#orphans-list"),

		// The Table Element - Datatables
		datatable: '',

		// Table Columns
		columns: [
		{ data: 'orphans.id' },
		{ data: 'users.name' },
		{ data: 'orphans.has_donation' },
		{ data: 'orphans.first_name' },
		{ data: 'orphans.middle_name' },
		{ data: 'orphans.last_name' },
		{ data: 'residence.city' },
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
    	fillTable: function() {
            var app = this;

            this.datatable = this.table.DataTable({
                oLanguage: this.oLanguage,
                columns: this.columns,
                "processing": true,
                "serverSide": true,
                "ajax": Helpers.API('orphans/get/' + app.showing),
            
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
            this.datatable.ajax.url(Helpers.API('orphans/get/' + this.showing));
            this.refresh();
    	},

        refresh: function() {
            this.datatable.ajax.reload(null, false);
            this.getStats();
        },

        getStats: function() {
            this.$http.get(Helpers.API('orphans/stats'), {}, function(stats) {
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

    Dialog.confirm(TRANSLATIONS.request["delete-orphan"], TRANSLATIONS.request.confirms["orphan-delete"], function(response) {
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
    Dialog.confirm(TRANSLATIONS.request["delete-orphans"], TRANSLATIONS.request.confirms["orphan-mass-delete"], function(response) {
        if (response === true) {
            Orphan.submitMassDelete();
            Main.selected = [];
        };
    });
});

$('body').on('click', '.play-video', function(e) {
    var video = $(this).data('video');

    VideoPlayer.play(video);
});