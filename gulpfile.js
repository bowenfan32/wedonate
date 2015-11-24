var gulp = require('gulp'),
gutil = require('gulp-util'),
uglify = require('gulp-uglify'),
concat = require('gulp-concat'),
jshint = require('gulp-jshint'),
minifycss = require('gulp-minify-css'),
autoprefixer = require('gulp-autoprefixer'),
imagemin   = require('gulp-imagemin'),
sass = require('gulp-sass'),
sourcemaps = require('gulp-sourcemaps'),
del = require('del'),
livereload = require('gulp-livereload')
rename = require('gulp-rename');

/*
-------------------------------
| CSS
-------------------------------
*/
gulp.task('css', function () {
  gulp.src('./assets/css/app.scss')
  .pipe(sass({errLogToConsole: true}))
  .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
  .pipe(gulp.dest('./public/css'))
  .pipe(minifycss())
  .pipe(gulp.dest('./public/css'))
  .pipe(rename('app.css'))
  .pipe(gulp.dest('./public/css'));
});

/*
-------------------------------
| Scripts
-------------------------------
*/
gulp.task('js', function () {
  gulp.src('./assets/js/*.js')
  .pipe(jshint('.jshintrc'))
  .pipe(jshint.reporter('default'))
  .pipe(concat('app.js'))
  // .pipe(uglify())
  .pipe(gulp.dest('./public/js'));
});

/*
-------------------------------
| Image
-------------------------------
*/
// gulp.task('img', function(){
//   gulp.src('./assets/img/**')
//   .pipe(imagemin())
//   .pipe(gulp.dest('./wp-content/themes/core/img'));
// });

/*
-------------------------------
| Clean
-------------------------------
| - clean out the files before we remake them incase some are left hanging
| around.
*/
// gulp.task('clean', ['clean'], function(cb) {
//   del(['./wp-content/themes/core/', './wp-content/themes/core/js', './wp-content/themes/core/img'], cb)
// });

/*
-------------------------------
| Watch
-------------------------------
*/
// Watch
gulp.task('watch', function() {

  // Watch .scss files
  gulp.watch('./assets/css/**/*.scss', ['css']);

  // Watch .js files
  gulp.watch('./assets/js/**/*.js', ['js']);

  // Watch image files
  // gulp.watch('./assets/img/**/*', ['img']);

  // Create LiveReload server
  livereload.listen();

});

/*
-------------------------------
| Default
-------------------------------
*/
gulp.task('default', function() {
  gulp.start('css', 'js');
  //gulp.start('css', 'js', 'img');
});
