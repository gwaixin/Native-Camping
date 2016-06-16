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
    // mix.sass('app.scss');
    mix.styles([
    	'bootstrap/dist/css/bootstrap.css',
    	'font-awesome/css/font-awesome.css'
    ], 'public/css/default-libs.min.css', 'node_modules').min;

    mix.scripts([
    	'jquery/dist/jquery.js',
    	'bootstrap/dist/js/bootstrap.js',
    	'angular/angular.js'
    ], 'public/js/default-libs.min.js', 'node_modules').min;

    mix
    .copy('node_modules/bootstrap/fonts/**', 'public/fonts')
    .copy('node_modules/font-awesome/fonts/**', 'public/fonts');
});
