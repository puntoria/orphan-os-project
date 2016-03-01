/**********************************************************************
    LOADING - VUE INSTANCE
**********************************************************************/
var Loading = new Vue({
    el: "#loading",

    data: {
        node: $("#loading"),
        progressBar: $("#loading .loading-progress")
    },

    methods: {
        play: function() {
            var app = this;
            app.progressBar.addClass('progress-animation');

            setTimeout(function() {
                app.progressBar.removeClass('progress-animation');
            }, 1000);
        },
    }
});