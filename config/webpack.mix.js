const mix = require('laravel-mix');
let tailwindcss = require('tailwindcss')

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

mix.postCss('resources/css/app.css', 'public/vendor/novaweb', [tailwindcss('tailwind.js')])
    .copy('resources/fonts/google-font-nunito.css', 'public/vendor/novaweb')
    .copyDirectory('resources/fonts/nunito-v12-latin', 'public/vendor/novaweb/fonts/nunito-v12-latin')
    .setPublicPath('public/vendor/novaweb')
    .version()
