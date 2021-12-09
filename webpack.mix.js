const mix = require('laravel-mix');

mix.setPublicPath('./');

mix.js('./source/js/mu-cos-posters.js', 'js/mu-cos-posters.js');

mix.postCss('./source/css/mu-cos-posters.css', 'css/mu-cos-posters.css', [
    require('postcss-import'),
    require('postcss-nesting'),
    require('tailwindcss'),
		require('autoprefixer')
  ]
);

if (mix.inProduction()) {
    mix.version();
}
