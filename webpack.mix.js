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
   .extract(['vue', 'lodash', 'popper.js', 'jquery', 'bootstrap', 'axios', 'socket.io-client'])
   .sass('resources/sass/app.scss', 'public/css')
   .version()

   // tinymce
   .scripts([
      'node_modules/tinymce/jquery.tinymce.js',
      'node_modules/tinymce/jquery.tinymce.min.js',
      'node_modules/tinymce/tinymce.js',
      'node_modules/tinymce/tinymce.min.js'
   ], 'public/node_modules/tinymce/tinymce.js')
   // .copyDirectory('node_modules/tinymce/plugins', 'public/node_modules/tinymce/plugins')
   .copyDirectory('node_modules/tinymce/skins', 'public/node_modules/tinymce/skins')
   .copyDirectory('node_modules/tinymce/themes', 'public/node_modules/tinymce/themes');