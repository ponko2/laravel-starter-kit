const elixir = require('laravel-elixir');
const config = elixir.config;

require('laravel-elixir-phpcs');
require('laravel-elixir-eslint');
require('laravel-elixir-stylelint');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
  mix.sass('app.scss')
    .browserify('main.js')
    .copy(
      'node_modules/bootstrap-sass/assets/fonts/bootstrap',
      'public/vendor/bootstrap/fonts'
    )
    .copy(
      'node_modules/font-awesome/fonts',
      'public/vendor/font-awesome/fonts'
    )
    .version([
      'js/main.js',
      'css/app.css'
    ])
    .phpcs([
      'app/**/*.php',
      'tests/**/*.php'
    ], {
      bin: 'vendor/bin/phpcs',
      standard: 'phpcs.xml'
    })
    .eslint(`${config.get('assets.js.folder')}/**/*.js`)
    .stylelint(`${config.get('assets.css.sass.folder')}/**/*.scss`)
    .browserSync();
});
