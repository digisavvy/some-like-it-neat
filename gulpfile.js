'use strict';

/**
 * Project configuration
 */
// Optional - Use your own project name here...
var project = 'somelikeitneat';
// Files that you want to package into a zip go here
var build = './build/';
// Your main project assets and naming 'source' instead of 'src' to avoid confusion with gulp.src
var source = './assets/';
var bower = './assets/bower_components/';

// Load plugins
var gulp = require('gulp');
var browserSync	= require('browser-sync');
var reload = browserSync.reload;
var autoprefixer = require('gulp-autoprefixer'); // Autoprefixing magic
var minifycss = require('gulp-minify-css');
var jshint = require('gulp-jshint');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var concat = require('gulp-concat');
var notify = require('gulp-notify');
var cmq = require('gulp-combine-media-queries');
var runSequence = require('gulp-run-sequence');
// Our Sass compiler
var sass = require('gulp-ruby-sass');
var del = require('del');
// Helps prevent stream crashing on errors
var plumber = require('gulp-plumber');

/**
 * Browser Sync
 *
 * The 'cherry on top!' Asynchronous browser syncing of assets across multiple devices!! Watches for changes to js, image and php files
 * Although, I think this is redundant, since we have a watch task that does this already.
 */
gulp.task('browser-sync', function() {
    var files = [
        '**/*.php'
    ];

    browserSync.init(files, {
        proxy: project + '.dev'
    });
});

/**
 * Styles
 *
 * Looking at src/sass and compiling the files into Expanded format, Autoprefixing and sending the files to the build folder
 */
gulp.task('styles', function () {
    return gulp.src([source+'sass/**/*.scss'])
    .pipe(plumber())
    .pipe(sass({ style: 'expanded', 'sourcemap=none': true }))
    .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
    .pipe(plumber.stop())
    .pipe(gulp.dest(source+'css'))
    .pipe(cmq()) // Combines Media Queries
    .pipe(reload({stream:true})) // Inject Styles when style file is created
    .pipe(rename({ suffix: '-min' }))
    .pipe(minifycss({keepBreaks:true}))
    .pipe(minifycss({ keepSpecialComments: 0 }))
    .pipe(gulp.dest(source+'css'))
    .pipe(reload({stream:true})) // Inject Styles when min style file is created
    .pipe(notify({ message: 'Styles task complete', onLast: true }));
});


/**
 * Scripts
 *
 * Look at src/js and concatenate those files, send them to assets/js where we then minimize the concatenated file.
 */
gulp.task('js', function() {
    return gulp.src([source+'js/vendor/**/*.js', source+'js/app/**/*.js', source+'bower_components/**/*.js'])
    .pipe(concat('production.js'))
    .pipe(gulp.dest(source+'js'))
    .pipe(rename({ suffix: '-min' }))
    .pipe(uglify())
    .pipe(gulp.dest(build+'assets/js/'))
    .pipe(notify({ message: 'Scripts task complete', onLast: true }));
});

/**
 * jsHint Tasks
 *
 * Scan our own JS code excluding vendor JS libraries and perform jsHint task.
 */
gulp.task( 'jsHint', function() {
    return gulp.src( [ source+'js/app/**/*.js' ] )
    .pipe(jshint('.jshintrc'))
    .pipe(jshint.reporter('default'));
} );

/**
 * Clean
 *
 * Being a little overzealous, but we're cleaning out the build folder, codekit-cache directory and annoying DS_Store files and Also
 * clearing out unoptimized image files in zip as those will have been moved and optimized
 */


gulp.task('cleanup', function(cb) {
	return del(['**/build', bower,'./library/vendors/composer','**/.sass-cache','**/.codekit-cache','**/.DS_Store','!node_modules/**'], cb);
});
gulp.task('cleanupFinal', function(cb) {
	return del(['**/build', bower,'**/.sass-cache','**/.codekit-cache','**/.DS_Store','!node_modules/**'], cb);
});

/**
 * Build task that moves essential theme files for production-ready sites
 *
 * First, we're moving PHP files to the build folder for redistribution. Also we're excluding the library, build and src directories. Why?
 * Excluding build prevents recursive copying and Inception levels of bullshit. We exclude library because there are certain non-php files
 * there that need to get moved as well. So I put the library directory into its own task. Excluding src because, well, we don't want to
 * distribute uniminified/unoptimized files. And, uh, grabbing screenshot.png cause I'm janky like that!
 */
gulp.task('buildPhp', function() {
    return gulp.src(['**/*.php', './style.css','./gulpfile.js','./package.json','./.bowercc','.gitignore', './screenshot.png','!./build/**','!./library/**','!./src/**'])
    .pipe(gulp.dest(build))
    .pipe(notify({ message: 'Moving files complete', onLast: true }));
});

// Copy Library to Build
gulp.task('buildAssets', function() {
    return gulp.src([source+'**', source+'js/production.js'])
    .pipe(gulp.dest(build+'/assets'))
    .pipe(notify({ message: 'Copy of Assets directory complete', onLast: true }));
});

// ==== TASKS ==== //
/**
 * Gulp Default Task
 *
 * Compiles styles, fires-up browser sync, watches js and php files. Note browser sync task watches php files
 *
 */
// Package Distributable Theme
gulp.task('build', function(cb) {
    runSequence('cleanup', 'styles', 'js', 'buildPhp', 'buildAssets', 'cleanupFinal', cb);
});

// Watch Task
gulp.task('default', ['styles', 'js', 'jsHint', 'browser-sync'], function () {
    gulp.watch(source+'sass/**/*.scss', ['styles']);
    gulp.watch(source+'js/app/**/*.js', ['js', browserSync.reload]);
    gulp.watch(source+'js/app/**/*.js', ['jsHint']);
});
