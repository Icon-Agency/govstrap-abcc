var gulp          = require('gulp'),
    sass          = require('gulp-sass'),
    prefix        = require('gulp-autoprefixer'),
    webpack       = require('webpack'),
    webpackStream = require('webpack-stream-fixed'),
    clean         = require('gulp-clean'),
    dirSync       = require('gulp-directory-sync');
    cleanCSS      = require('gulp-clean-css');
    // browserSync   = require('browser-sync').create();

// log catch 'ENOENT' error typically caused by renaming watched folders
var silentFail = function(error) {
  if (error.code === 'ENOENT') {
    return;
  }
};

/**
 * @task sass
 * Compile files from scss
 */
gulp.task('styles', function () {

  /**
   * Match bootstrap upstream requirements.
   * @type Array
   */
  var prefixOptions = [
    "Android >= 5",
    "Chrome >= 49",
    "Firefox >= 35",
    "Explorer >= 10",
    "iOS >= 10",
    "Opera >= 40",
    "Safari >= 10"
  ];

  gulp.src('./build/css/*', {read: false}).pipe(clean());

  return gulp.src('src/sass/*.scss') // the source .scss file
    .pipe(sass().on('error', sass.logError))
    .pipe(prefix({ browsers: prefixOptions, cascade: true })) // pass the file through autoprefixer
    .pipe(cleanCSS())
    .pipe(gulp.dest('./build/css'))
    // .pipe(browserSync.stream()); // output .css file to css folder
});


/**
 * @task scripts
 * Compile files from scripts
 */
gulp.task('scripts', function () {

  var config = require('./webpack.config.js');

  gulp.src('./build/js/*', {read: false}).pipe(clean());

  return gulp.src('./src/js/*.js')
      .pipe(webpackStream(config, webpack))
      .pipe(gulp.dest('./build/js'))
});


/**
 * @task browser-sync
 * Startup browsersync
 */
gulp.task('serve', function() {
    // browserSync.init({
    //     server: "./build"
    // });
    gulp.watch("src/sass/**/*.scss", ['styles']).on('error', silentFail);
    // gulp.watch("build/js/*.js", ['scripts']).on('error', silentFail);
    // gulp.watch("build/*.html").on('change', browserSync.reload);
    // gulp.watch("build/js/*.js").on('change', browserSync.reload);
});


//Watch task
gulp.task('default',function() {
  gulp.start(['scripts', 'styles', 'serve']);
});
