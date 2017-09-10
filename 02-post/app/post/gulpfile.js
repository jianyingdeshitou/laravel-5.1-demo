var elixir = require('laravel-elixir');
var gulp = require('gulp');
var rename = require('gulp-rename');

gulp.task("copyfiles", function () {
    var npm_path = 'node_modules/';
    var res_path = 'resources/assets/';
    var pub_path = 'public/'

    // jquery
    gulp.src(npm_path + 'jquery/dist/jquery.min.js')
        .pipe(gulp.dest(pub_path + "js/"));

    // bootstrap
    gulp.src(npm_path + 'bootstrap/dist/js/bootstrap.min.js')
        .pipe(gulp.dest(pub_path + "js/"));
    gulp.src(npm_path + 'bootstrap/dist/css/bootstrap.min.css')
        .pipe(gulp.dest(pub_path + "css/"));
    gulp.src(npm_path + 'bootstrap/dist/fonts/**')
        .pipe(gulp.dest(pub_path + "fonts/"));

    // fontawesome
    gulp.src(npm_path + 'font-awesome/css/font-awesome.min.css')
        .pipe(gulp.dest(pub_path + "css/"));
    gulp.src(npm_path + 'font-awesome/fonts/**')
        .pipe(gulp.dest(pub_path + "fonts/"));
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
//    mix.scripts(['jquery.js',
//            'bootstrap.js',
//            'jquery.dataTables.js',
//            'datatables-bootstrap3.js',
//    ], 'public/js/admin.js')
    mix.sass('app.scss');
    mix.sass('admin.scss');
});
