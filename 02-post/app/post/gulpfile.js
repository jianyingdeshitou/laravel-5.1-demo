var elixir = require('laravel-elixir');
var gulp = require('gulp');
var rename = require('gulp-rename');

gulp.task("copyfiles", function () {
    var npm_path = 'node_modules/';
    var res_path = 'resources/assets/';
    var pub_path = 'public/'

    // jquery
    gulp.src(npm_path + 'jquery/dist/jquery.js')
        .pipe(gulp.dest(res_path + "js/"));

    // bootstrap
    gulp.src(npm_path + 'bootstrap/dist/js/bootstrap.js')
        .pipe(gulp.dest(res_path + "js/"));
    gulp.src(npm_path + 'bootstrap/dist/fonts/**')
        .pipe(gulp.dest(pub_path + "fonts/"));

    // fontawesome
    gulp.src(npm_path + 'font-awesome/fonts/**')
        .pipe(gulp.dest(pub_path + "fonts/"));

    // datatables
    gulp.src(npm_path + 'datatables/media/js/jquery.dataTables.js')
        .pipe(gulp.dest(res_path + "js/"));

    // datatables-bootstrap3-plugin
    gulp.src(npm_path + 'datatables-bootstrap3-plugin/media/css/datatables-bootstrap3.css')
        .pipe(rename('datatables-bootstrap3.scss'))
        .pipe(gulp.dest(res_path + "sass/"));
    gulp.src(npm_path + 'datatables-bootstrap3-plugin/media/js/datatables-bootstrap3.js')
        .pipe(gulp.dest(res_path + "js/"));
});

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

elixir(function(mix) {
    mix.scripts(['jquery.js',
            'bootstrap.js',
            'jquery.dataTables.js',
            'datatables-bootstrap3.js',
    ], 'public/js/admin.js')
    mix.sass('app.scss');
    mix.sass('admin.scss');
});
