/**********************************************************************
    USERS VUE INSTANCE (Users Table)
**********************************************************************/
var Users = new Vue({
    el: '#users',

    data: {
        // Users List
        users: '',
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

        app.getUsersList(function() {
            app.fillTable(app.users.data);
        });
    },

    methods: {
        getUsersList: function(_callback) {
            this.$http.get('users', function(data, status, request) {
                this.users = data;

                this.users.active = this.users.data.filter(function(obj) {
                    return obj.active == 1;
                });

                this.users.inactive = this.users.data.filter(function(obj) {
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
                          .rows.add(this.users[data])
                          .draw();
            this.showing = data;
        },

        refresh: function() {
            this.getUsersList(function() {
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

    Dialog.confirm('Delete User', 'Are you sure you want to delete this user from the database?', function(response) {
        if (response === true) {
            User.delete(userID);
        };
    });
});

$('body').on('click', '.mass-delete-users-toggle', function(e) {
    Dialog.confirm('Delete Users', 'Are you sure you want to delete these users from the database?', function(response) {
        if (response === true) {
            User.submitMassDelete();
            Users.selected = [];
        };
    });
});