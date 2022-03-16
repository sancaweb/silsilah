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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/pages/user.js', 'public/js/pages')
    .js('resources/js/pages/userTrash.js', 'public/js/pages')
    .js('resources/js/pages/activity.js', 'public/js/pages')
    .js('resources/js/pages/dashboard.js', 'public/js/pages')
    .js('resources/js/pages/rolePermission.js', 'public/js/pages')
    .js('resources/js/pages/assignPermission.js', 'public/js/pages')
    .js('resources/js/pages/profile.js', 'public/js/pages')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/tree.scss', 'public/css')
    .sourceMaps();
