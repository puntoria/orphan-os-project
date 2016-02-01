/**********************************************************************
    DONORS VUE INSTANCE (Donors Table)
**********************************************************************/
var Donors = new Vue({
    el: '#donors',

    data: {

        showing: 'data',

        // Search Query for the table
        search: '',

        // The Table Element - jQuery
        table: $("#donors-list"),

        // The Table Element - Datatables
        datatable: '',

        // Table Columns
        columns: [
        { data: 'users.id' },
        { data: 'users.name' },
        { data: 'users.email' },
        { data: 'users.language' },
        { data: 'users.active' },
        { data: 'users.orphans', 'orderable': false, 'searchable': false },
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
            activeCount: 0,
            inactiveCount: 0
        }
    },

    ready: function() {
        this.fillTable();
        this.getStats();
    },

    methods: {
        fillTable: function(data) {
            var app = this;

            this.datatable = this.table.DataTable( {
                oLanguage: this.oLanguage,
                columns: this.columns,
                "processing": true,
                "serverSide": true,
                "ajax": Helpers.API('donors/get/' + app.showing),
            
                "fnRowCallback": function( row, data) {
                    if(Helpers.inArray(data.info.id, app.selected)) {
                        $(row).addClass('selected');
                    };
                }
            } );

            this.datatable.on('processing', function(e, settings, processing) {
                Loading.play();
            });
        },

        filter: function(data) {
            this.showing = data;
            this.datatable.ajax.url(Helpers.API('donors/get/' + this.showing));
            this.refresh();
        },

        refresh: function() {
            this.datatable.ajax.reload(null, false);
            this.getStats();
        },

        getStats: function() {
            this.$http.get(Helpers.API('donors/stats'), {}, function(stats) {
                this.stats = stats.data;
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
    Donors JQUERY
*************************************/ 
$('body').on('click', '.add-new-donor-toggle', function(e) {
    Donor.currentID = 'new';
    Donor.new();
});

$('body').on('click', '#donors-list .select-row', function(e) {
    var self = $(this);
    var donorID = parseInt( self.text() );

    if (Helpers.inArray(donorID, Donors.selected)) {
        Donors.selected.splice(Donors.selected.indexOf(donorID), 1);
        self.closest('tr').removeClass('selected');
        return;
    }

    Donors.selected.push(donorID);
    self.closest('tr').addClass('selected');
});

$('body').on('click', '#donors .table-row-settings .change', function(e) {
    var donorID = parseInt( $(this).closest('ul.table-row-settings').data('donor-id') );

    Donor.currentID = donorID;
    Donor.show();
});

$('body').on('click', '#donors .table-row-settings .delete', function(e) {
    var donorID = parseInt( $(this).closest('ul.table-row-settings').data('donor-id') );

    Dialog.confirm(TRANSLATIONS.request["delete-donor"], TRANSLATIONS.request.confirms["donor-delete"], function(response) {
        if (response === true) {
            Donor.delete(donorID);
        };
    });
});

$('body').on('click', '.mass-delete-donors-toggle', function(e) {
    Dialog.confirm(TRANSLATIONS.request["delete-donors"], TRANSLATIONS.request.confirms["donor-mass-delete"], function(response) {
        if (response === true) {
            Donor.submitMassDelete();
            Donors.selected = [];
        };
    });
});