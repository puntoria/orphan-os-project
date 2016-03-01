/**********************************************************************
    GALLERY - VUE INSTANCE
**********************************************************************/
var Gallery = new Vue({
    el: "#gallery",

    data: {
        node: $("#gallery"),
        photos: [],
        currentIndex: false
    },

    created: function() {

    },

    methods: {
        show: function() {
            this.node.show();
        },

        hide: function() {
            this.node.hide();
        },

        make: function(photos, currentIndex) {
            this.photos = photos;
            this.currentIndex = currentIndex;

            this.show();
        },

        current: function() {
            return this.photos[this.currentIndex];
        },

        previous: function() {
            this.currentIndex = (this.currentIndex + this.photos.length - 1) % this.photos.length;
        },

        next: function() {
            this.currentIndex = (this.currentIndex + 1) % this.photos.length;
        }
    }
});