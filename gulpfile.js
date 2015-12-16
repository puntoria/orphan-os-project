var elixir = require('laravel-elixir');

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
 	.scripts([
 		'app/jquery.js',
 		'app/bootstrap.js',
 		'app/theme.js',
 		'app/script.js',
 		'app/datatables.js',
 		'app/vue.js',
 		'app/http.js',
 		'app/helpers.js',
 		'app.js'], 'public/js/app.js')
 	.version([
 		'public/css/app.css', 
 		'public/js/app.js'
 		]);
 	});
