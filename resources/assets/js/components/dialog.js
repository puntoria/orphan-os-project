/**********************************************************************
    DIALOG - VUE INSTANCE
**********************************************************************/
var Dialog = new Vue({
    el: "#dialog",

    data: {
        node: $("#dialog"),
        title: 'Dialog Title',
        content: 'Dialog Content',

        isConfirm: false,
        callback: false
    },

    created: function() {
        this.hide();
    },

    methods: {
        show: function(seconds) {
            this.node.show();

            setTimeout(function() {
                this.hide();
            }.bind(this), seconds);
        },

        hide: function() {
            this.node.hide();
        },

        make: function(title, content, seconds) {
            this.title = title;
            this.content = content;

            this.show(seconds);
        },

        confirm: function(title, content, _callback) {
            this.isConfirm = true;

            this.title = title;
            this.content = content;
            this.node.show();

            this.callback = _callback;
        },

        setConfirm: function(value) {
            this.isConfirm = false;
            this.hide();

            this.callback(value);
        }
    }
});