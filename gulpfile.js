var elixir = require('laravel-elixir');

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

// elixir(function(mix) {
//     mix.sass('app.scss');
// });
elixir(function(mix) {
  mix.scripts(['dragula.min.js', 'drag.js'], 'public/js/dragula.js');

  mix.scripts('add_student.js', 'public/js/add_student.js')
  mix.scripts('add_day.js', 'public/js/add_day.js')
  mix.scripts('commenting.js', 'public/js/commenting.js')

  mix.styles('app.css');
  mix.styles(
    ['dragula.css', 'drag.css'],
    'public/css/dragula.css');
});
