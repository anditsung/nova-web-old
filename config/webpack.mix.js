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

// mix.postCss('resources/css/app.css', 'public/vendor/novaweb', [tailwindcss('tailwind.js')])
//     .copy('resources/fonts/google-font-nunito.css', 'public/vendor/novaweb')
//     .copyDirectory('resources/fonts/nunito-v12-latin', 'public/vendor/novaweb/fonts/nunito-v12-latin')
//     .setPublicPath('public/vendor/novaweb')
//     .version()

// mix.copy('resources/fonts/google-font-nunito.css', 'public/vendor/novaweb')
//     .copyDirectory('resources/fonts/nunito-v12-latin', 'public/vendor/novaweb/fonts/nunito-v12-latin')
//     .setPublicPath('public/vendor/novaweb')
//     .version()

mix.js('resources/js/app.js', '')
    .extract([
        'vue',
        'vue-toasted',
        'axios'
    ])
    .webpackConfig({
        resolve: {
            alias: {
                nova: __dirname + '/nova/resources/js',
            }
        }
    })
    .copy('resources/fonts/google-font-nunito.css', 'public/vendor/novaweb')
    .copyDirectory('resources/fonts/nunito-v12-latin', 'public/vendor/novaweb/fonts/nunito-v12-latin')
    .setPublicPath('public/vendor/novaweb')
    .version()

// mix.js('resources/js/app.js','')
//     .extract([
//         'axios',
//         'chartist-plugin-tooltips',
//         'chartist',
//         'codemirror',
//         'flatpickr',
//         'form-backend-validation',
//         'inflector-js',
//         'laravel-nova',
//         'lodash',
//         'markdown-it',
//         'marked',
//         'moment-timezone',
//         'moment',
//         'numbro',
//         'places.js',
//         'popper.js',
//         'portal-vue',
//         'trix',
//         'vue-async-computed',
//         'vue-clickaway',
//         'vue-router',
//         'vue-toasted',
//         'vue',
//     ])
//     .webpackConfig({
//         resolve: {
//             alias: {
//                 '@': path.resolve(__dirname, 'nova/resources/js/'),
//             },
//         },
//     })
//     .copy('resources/fonts/google-font-nunito.css', 'public/vendor/novaweb')
//     .copyDirectory('resources/fonts/nunito-v12-latin', 'public/vendor/novaweb/fonts/nunito-v12-latin')
//     .setPublicPath('public/vendor/novaweb')
//     .version()
