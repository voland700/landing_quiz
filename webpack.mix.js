const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);


mix.styles([
    'resources/assets/front/css/app.min.css',
], 'public/css/main.css');

mix.scripts([
    'resources/assets/front/js/rellax.min.js',
    'resources/assets/front/js/intlTelInput/intlTelInput.min.js',
    'resources/assets/front/js/intlTelInput/utils.js',
    'resources/assets/front/js/cleave/cleave.min.js',
    'resources/assets/front/js/cleave/cleave-phone.ru.js',
], 'public/js/main.js').sourceMaps();

mix.copyDirectory('resources/assets/front/fonts', 'public/fonts');
mix.copyDirectory('resources/assets/front/images/src', 'public/images/src');


mix.styles([
    'resources/assets/admin/plugins/fontawesome-free/css/all.min.css',
    'resources/assets/admin/css/adminlte.min.css',
    'resources/assets/admin/plugins/select2/css/select2.min.css',
    'resources/assets/admin/plugins/summernote/summernote-bs4.min.css',
], 'public/assets/admin/css/admin.css');

mix.scripts([
    'resources/assets/admin/plugins/jquery/jquery.min.js',
    'resources/assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js',
    'resources/assets/admin/js/adminlte.min.js',
    'resources/assets/admin/plugins/bs-custom-file-input/bs-custom-file-input.js',
    'resources/assets/admin/plugins/select2/js/select2.min.js',
    'resources/assets/admin/plugins/select2/js/i18n/ru.js',
    'resources/assets/admin/js/demo.js',
    'resources/assets/admin/plugins/summernote/summernote-bs4.min.js',
    'resources/assets/admin/plugins/summernote/summernote-ru-RU.min.js',
], 'public/assets/admin/js/admin.js');

mix.copyDirectory('resources/assets/admin/img', 'public/assets/admin/img');
mix.copyDirectory('resources/assets/admin/plugins/fontawesome-free/webfonts', 'public/assets/admin/webfonts');

mix.copy('resources/assets/admin/css/adminlte.css.map', 'public/assets/admin/css/adminlte.css.map');
mix.copy('resources/assets/admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js.map', 'public/assets/admin/js/bs-custom-file-input.js.map');
mix.copy('resources/assets/admin/plugins/summernote/summernote-bs4.min.js.map', 'public/assets/admin/js/summernote-bs4.min.js.map');
mix.copy('resources/assets/admin/plugins/summernote/font', 'public/assets/admin/css/font');
