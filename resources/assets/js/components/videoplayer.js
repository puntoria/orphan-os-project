/**********************************************************************
    VIDEOPLAYER - VUE INSTANCE
**********************************************************************/
var VideoPlayer = new Vue({
    el: "#videoplayer",

    data: {
        node: $("#videoplayer"),
        source: false,
        width: 0,
        height: 0,

        default: {
            width: 400,
            height: 300
        }
    },

    created: function() {

    },

    methods: {
        show: function() {
            this.node.show();
        },

        hide: function() {
            this.node.hide();
            this.source = false;
        },

        play: function(source, width, height) {
            this.width = width || this.default.width;
            this.height = height || this.default.height;

            this.source = source;
            this.show();
        }
    }
});