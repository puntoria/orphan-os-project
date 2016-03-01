var elixir = require('laravel-elixir');
var app = require('./resources/assets/js/app.js');

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
 	.scripts(app.scripts, 'public/js/app.js')
 	.version([
 		'public/css/app.css', 
 		'public/js/app.js'
 		]);
 	});
