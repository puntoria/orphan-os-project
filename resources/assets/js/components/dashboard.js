/**********************************************************************
    DASHBOARD - VUE INSTANCE
**********************************************************************/
var Dashboard = new Vue({
    el: "#dashboard",

    data: {
        stats: {}
    },

    ready: function() {
        var app = this;

        app.$http.get('dashboard', {}, function(data) {
            app.stats = data.data;
            app.orphansChart();
            app.donorsChart();
        });
    },

    methods: {

        orphansChart: function() {
            data = [{
                value: this.stats.orphans.withDonation,
                color:"#F7464A",
                highlight: "#FF5A5E",
                label: TRANSLATIONS.stats["with-donation"]
            },
            {
                value: this.stats.orphans.withoutDonation,
                color: "#46BFBD",
                highlight: "#5AD3D1",
                label: TRANSLATIONS.stats["without-donation"]
            }];

            options = {
                segmentShowStroke : true,
                segmentStrokeColor : "#fff",
                segmentStrokeWidth : 2,
                percentageInnerCutout : 50,
                animationSteps : 100,
                animationEasing : "easeOutQuart",
                animateRotate : true,
                animateScale : false,
                legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"

            };

            var myDoughnutChart = new Chart($("#orphans-chart").get(0).getContext('2d')).Doughnut(data,options);
        },

       donorsChart: function() {
            data = [{
                value:  this.stats.donors.active,
                color: "#FDB45C",
                highlight: "#FFC870",
                label: TRANSLATIONS.stats.active
            },
            {
                value:  this.stats.donors.inactive,
                color: "#46BFBD",
                highlight: "#5AD3D1",
                label: TRANSLATIONS.stats.inactive
            }];

            options = {
                segmentShowStroke : true,
                segmentStrokeColor : "#fff",
                segmentStrokeWidth : 2,
                percentageInnerCutout : 50,
                animationSteps : 100,
                animationEasing : "easeOutQuart",
                animateRotate : true,
                animateScale : false,
                legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"

            };

            var myDoughnutChart = new Chart($("#donors-chart").get(0).getContext('2d')).Doughnut(data,options);
        }
    }
});