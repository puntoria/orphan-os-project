/**********************************************************************
    USERS VUE INSTANCE (Users Table)
**********************************************************************/
var Users = new Vue({
    el: '#users',

    data: {
        showing: 'data',

        // Search Query for the table
        search: '',

        // The Table Element - jQuery
        table: $("#users-list"),

        // The Table Element - Datatables
        datatable: '',

        // Table Columns
        columns: [
        { data: 'id' },
        { data: 'name' },
        { data: 'email' },
        { data: 'type' },
        { data: 'language' },
        { data: 'active' },
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
                "ajax": Helpers.API('users/get/' + app.showing),
            
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
            this.datatable.ajax.url(Helpers.API('users/get/' + this.showing));
            this.refresh();
        },

        refresh: function() {
            this.datatable.ajax.reload(null, false);
            this.getStats();
        },

        getStats: function() {
            this.$http.get(Helpers.API('users/stats'), {}, function(stats) {
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
    Users
*************************************/ 
$('body').on('click', '.add-new-user-toggle', function(e) {
    User.currentID = 'new';
    User.new();
});

$('body').on('click', '#users-list .select-row', function(e) {
    var self = $(this);
    var userID = parseInt( self.text() );

    if (Helpers.inArray(userID, Users.selected)) {
        Users.selected.splice(Users.selected.indexOf(userID), 1);
        self.closest('tr').removeClass('selected');
        return;
    }

    Users.selected.push(userID);
    self.closest('tr').addClass('selected');
});

$('body').on('click', '#users .table-row-settings .change', function(e) {
    var userID = parseInt( $(this).closest('ul.table-row-settings').data('user-id') );

    User.currentID = userID;
    User.show();
});

$('body').on('click', '#users .table-row-settings .delete', function(e) {
    var userID = parseInt( $(this).closest('ul.table-row-settings').data('user-id') );

    Dialog.confirm(TRANSLATIONS.request["delete-user"], TRANSLATIONS.request.confirms["user-delete"], function(response) {
        if (response === true) {
            User.delete(userID);
        };
    });
});

$('body').on('click', '.mass-delete-users-toggle', function(e) {
    Dialog.confirm(TRANSLATIONS.request["delete-users"], TRANSLATIONS.request.confirms["user-mass-delete"], function(response) {
        if (response === true) {
            User.submitMassDelete();
            Users.selected = [];
        };
    });
});