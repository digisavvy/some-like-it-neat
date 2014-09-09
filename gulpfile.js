// Load plugins
var gulp = require('gulp'),
    browserSync = require('browser-sync'),
    reload      = browserSync.reload, 
    sass = require('gulp-ruby-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    minifycss = require('gulp-minify-css'),
    jshint = require('gulp-jshint'),
    uglify = require('gulp-uglify'),
    imagemin = require('gulp-imagemin'),
    rename = require('gulp-rename'),
    clean = require('gulp-clean'),
    concat = require('gulp-concat'),
    notify = require('gulp-notify'),
    cache = require('gulp-cache')
    // livereload = require('gulp-livereload');

// Browser Sync
gulp.task('browser-sync', function() {
    browserSync({
        proxy: "somelikeitneat.dev"
    });
});

// Styles
gulp.task('styles', function() {
  return gulp.src('library/assets/sass/style.scss')
    .pipe(sass({ style: 'expanded', }))
    .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
    .pipe(gulp.dest('./'))
    .pipe(reload({stream:true}))
    .pipe(rename({ suffix: '.min' }))
    .pipe(minifycss())
    .pipe(gulp.dest('dist/styles'))
    .pipe(notify({ message: 'Styles task complete' }));
});

// Scripts
gulp.task('scripts', function() {
  return gulp.src('library/assets/js/**/*.js')
    // .pipe(jshint('.jshintrc'))
    // .pipe(jshint.reporter('default'))
    .pipe(concat('production.js'))
    .pipe(gulp.dest('dist/scripts'))
    .pipe(rename({ suffix: '.min' }))
    .pipe(uglify())
    .pipe(gulp.dest('dist/scripts'))
    .pipe(notify({ message: 'Scripts task complete' }));
});

// Images
gulp.task('images', function() {
  return gulp.src('images/**/*')
    .pipe(cache(imagemin({ optimizationLevel: 3, progressive: true, interlaced: true })))
    .pipe(gulp.dest('dist/images'))
    .pipe(notify({ message: 'Images task complete' }));
});

// Clean
gulp.task('clean', function() {
  return gulp.src(['dist/styles', 'dist/scripts', 'dist/images'], {read: false})
    .pipe(clean());
});

// Default task
gulp.task('default', ['clean', 'browser-sync'], function() {
    gulp.start('styles', 'scripts', 'images');
    gulp.watch('library/assets/sass/**/*.scss', ['styles']);
});

// Watch
gulp.task('watch', function() {

  // Watch .scss files
  gulp.watch('library/assets/sass/**/*.scss', ['styles']);

  // Watch .js files
  gulp.watch('library/assets/js/**/*.js', ['scripts']);

  // Watch image files
  gulp.watch('src/images/**/*', ['images']);

  // Create LiveReload server
  // var server = livereload();

  // Watch any files in dist/, reload on change
  gulp.watch(['dist/**']).on('change', function(file) {
    server.changed(file.path);
  });

});