// webpack.mix.js for Laravel Mix

const mix = require('laravel-mix');

// Example configuration
mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

// Enable versioning in production
if (mix.inProduction()) {
    mix.version();
}