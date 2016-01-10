/**********************************************************************
    DONORS VUE INSTANCE (Donors Table)
**********************************************************************/
var Donors = new Vue({
    el: '#donors',

    data: {
        // Donors List
        donors: '',
        showing: 'data',

        // Search Query for the table
        search: '',

        // The Table Element - jQuery
        table: $("#donors-list"),

        // The Table Element - Datatables
        datatable: '',

        // Table Columns
        columns: [
        { data: 'id' },
        { data: 'name' },
        { data: 'email' },
        { data: 'language' },
        { data: 'active' },
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

        app.getDonorsList(function() {
            app.fillTable(app.donors.data);
        });
    },

    methods: {
        getDonorsList: function(_callback) {
            this.$http.get('donors', function(data, status, request) {
                this.donors = data;

                this.donors.active = this.donors.data.filter(function(obj) {
                    return obj.active == 1;
                });

                this.donors.inactive = this.donors.data.filter(function(obj) {
                    return obj.active == 0;
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
                          .rows.add(this.donors[data])
                          .draw();
            this.showing = data;
        },

        refresh: function() {
            this.getDonorsList(function() {
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

    Dialog.confirm('Delete Donor', 'Are you sure you want to delete this donor from the database?', function(response) {
        if (response === true) {
            Donor.delete(donorID);
        };
    });
});

$('body').on('click', '.mass-delete-donors-toggle', function(e) {
    Dialog.confirm('Delete Donors', 'Are you sure you want to delete these donors from the database?', function(response) {
        if (response === true) {
            Donor.submitMassDelete();
            Donors.selected = [];
        };
    });
});