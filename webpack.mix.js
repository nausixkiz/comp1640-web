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
mix.copyDirectory('resources/vendor', 'public/vendor')

mix.js('resources/js/plugins/datatable.js', 'public/js/plugins')
    .js('resources/js/plugins/bootstrap-fileinput.js', 'public/js/plugins')

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/scss/app.scss', 'public/css')
    .sass('resources/scss/bootstrap-custom.scss', 'public/css')
    .sass('resources/scss/icons.scss', 'public/css')
    .sass('resources/scss/plugins.scss', 'public/css')
    .sourceMaps()

mix.extract([
    'lodash', 'jquery', '@popperjs/core', 'bootstrap', 'simplebar', 'metismenu', 'node-waves',
    'toastr', 'sweetalert2', 'select2', 'bootstrap-fileinput', 'flatpickr', 'jquery-ui',
    '@ckeditor/ckeditor5-build-classic',
    ])

if (mix.inProduction()) {
    mix.version();
}
