let mix = require('laravel-mix');
let webpack = require('webpack');

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css');

mix.copyDirectory('resources/assets/img', 'public/img');

mix.browserSync({
    proxy: "localhost:8000"
});