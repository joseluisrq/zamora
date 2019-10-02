const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */


mix.scripts([
        'resources/plantilla/js/template.js',
        'resources/plantilla/js/dashboard.js',
        'resources/plantilla/js/chart.js',
        'resources/plantilla/js/sweetalert2.js',

    ], 'public/js/all.js')
    .js('resources/js/app.js', 'public/js/app.js');