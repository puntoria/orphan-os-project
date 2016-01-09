var elixir = require('laravel-elixir');

var APP_SCRIPTS = [
	'app/jquery.js',
	'app/bootstrap.js',
	'app/theme.js',
	'app/script.js',
	'app/datatables.js',
	'app/dropzone.js',
	'app/cropper.js',
	'app/vue.js',
	'app/http.js',
	'app/helpers.js',
];

var CUSTOM_SCRIPTS = [
	'app.js'
];

var SCRIPTS = APP_SCRIPTS.concat(CUSTOM_SCRIPTS);


/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

 elixir(function(mix) {
 	mix.sass('app.scss');

 	mix.copy('resources/assets/fonts', 'public/fonts')
 	.scripts(SCRIPTS, 'public/js/app.js')
 	.version([
 		'public/css/app.css', 
 		'public/js/app.js'
 		]);
 	});
