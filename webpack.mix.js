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
 mix.scripts(
    [
        'node_modules/bootbox/dist/bootbox.min.js',
        'node_modules/sr-basic-feature/dist/sr-basic-functions.js',
        'node_modules/sr-basic-feature/dist/sr-basic-feature.js',
        'node_modules/sr-bootstrap-components/dist/sr-ajax-file-upload.js',
        'node_modules/sr-bootstrap-components/dist/sr-datatable.js',
    ],  
    'public/js/backend.js'
);

mix.styles(
    [
        'node_modules/sr-basic-feature/dist/sr-basic-feature.css',
        'node_modules/sr-bootstrap-components/dist/sr-ajax-file-upload.css',
        'node_modules/sr-bootstrap-components/dist/sr-datatable.css',
    ],  
    'public/css/backend.css'
);
