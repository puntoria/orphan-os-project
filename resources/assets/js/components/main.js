// SCRIPTS
Vue.http.options.root = API_URL;
Vue.http.headers.common['X-CSRF-TOKEN'] = TOKEN;

var sidebar = $('.sidebar');
var page = $('#page-wrapper');
$('.toggle-sidebar').click(function(e) {
	e.preventDefault();

	if (sidebar.hasClass('inactive')) {
		sidebar.removeClass('inactive');
		page.css('margin-left', '250px');
	} else {
		sidebar.addClass('inactive');
		page.css('margin-left', '0px');
		$(this).addClass('toggled');
	}
});

$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    startYear: 2000,
});