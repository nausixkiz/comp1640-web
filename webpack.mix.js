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

mix.copyDirectory('resources/images', 'public/images')

mix.js('resources/js/plugins/datatable.js', 'public/js/plugins')

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/scss/app.scss', 'public/css')
    .sass('resources/scss/bootstrap-custom.scss', 'public/css')
    .sass('resources/scss/icons.scss', 'public/css')
    .sourceMaps()

mix.extract([
    'jquery', 'bootstrap-sass', 'datatables.net', 'datatables.net-bs'
    ])
    .autoload({
        jquery: ['$', 'window.jQuery', 'jQuery', 'jquery'],
        DataTable : 'datatables.net-bs'
    });
