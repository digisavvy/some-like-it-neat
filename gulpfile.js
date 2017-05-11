'use strict';

/**
 * Project Setup
 *
 * Setting up variables for project name and directories
*/

/******************************************************************************
| >   PROJECT VARIABLES
******************************************************************************/
var project    = 'slin';
var url        = 'slin.dev';
var build      = './build/';
var vendors    = './library/vendors/';
var source     = 'assets/';
var phpSource  = ['**/*.php', 'page-templates/**/*.php', '!library/**/*', '!wpcs/**/*', '!node_modules/**/*', '!vendor/**/*', '!assets/bower_components/**/*', '!**/*-min.css', '!assets/js/vendor/*', '!assets/css/*', '!**/*-min.js', '!assets/js/production.js'];
var themeBuild = ['**/*.php', 'page-templates/**/*.php', './style.css', './gulpfile.js', './.jshintrc', './.bowerrc', './.gitignore', 'composer.phar', './*.json', './*.md', './screenshot.png', '!library/**/*', '!wpcs/**/*', '!node_modules/**/*', '!vendor/**/*', '!assets/bower_components/**/*', '!**/*-min.css', '!assets/js/vendor/*', '!assets/css/*', '!**/*-min.js', '!assets/js/production.js'];

/******************************************************************************
| >   PLUGINS
******************************************************************************/
var autoprefixer = require('gulp-autoprefixer');
var browserSync  = require('browser-sync').create();
var concat       = require('gulp-concat');
var del          = require('del');
var filter       = require('gulp-filter');
var gulp         = require('gulp');
var imagemin     = require('gulp-imagemin');
var jshint       = require('gulp-jshint');
var minifycss    = require('gulp-uglifycss');
var notify       = require('gulp-notify');
var phpcs        = require('gulp-phpcs');
var pixrem       = require('gulp-pixrem');
var plugins      = require('gulp-load-plugins')({ camelize: true });
var plumber      = require('gulp-plumber');
var reload       = browserSync.reload;
var rename       = require('gulp-rename');
var replace      = require('gulp-replace');
var runSequence  = require('gulp-run-sequence');
var sass         = require('gulp-sass');
var sourcemaps   = require('gulp-sourcemaps');
var uglify       = require('gulp-uglify');
var zip          = require('gulp-zip');

/**
 * Browser Sync
 *
 * The 'cherry on top!' Asynchronous browser syncing of assets across multiple devices!! Watches for changes to js, image and php files
 * Although, I think this is redundant, since we have a watch task that does this already.
*/
gulp.task('browser-sync', function() {
  var files = [
    '**/*.php', '**/*.js',
    '**/*.{png,jpg,gif}'
  ];
  browserSync.init(files, {
    proxy: url
  });
});

/******************************************************************************
| >   CSS TASKS
******************************************************************************/
gulp.task('styles', function() {
  return gulp.src([
      source + 'sass/**/*.scss',
      '!' + source + 'sass/**/navigation-offcanvas.scss',
      '!' + source + 'sass/**/flexnav.scss'
  ])
    .pipe(plumber({
      errorHandler: function(err) {
        console.log(err);
        this.emit('end');
      }
    }))
    .pipe(sourcemaps.init())
    .pipe(sass({
        sourceComments: 'map',
        sourceMap: 'sass',
        outputStyle: 'nested'
    }).on('error', sass.logError))
    .pipe(autoprefixer(
      'last 2 version',
      'safari 5', 'ie 8',
      'ie 9',
      'opera 12.1',
      'ios 6',
      'android 4'
    ))
    .pipe(sourcemaps.write('../maps'))
    .pipe(plumber.stop())
    .pipe(replace('@charset "UTF-8";', '')) // Removes UTF-8 Encoding string atop CSS files
    .pipe(gulp.dest(source + 'css'))
    .pipe(filter('**/*.css')) // Filtering stream to only css files
    .pipe(reload({stream:true})) // Inject Styles when style file is created
    .pipe(rename({ suffix: '-min' }))
    .pipe(minifycss({
      maxLineLen: 80
    }))
    .pipe(gulp.dest(source + 'css'))
    .pipe(reload({stream:true})) // Inject Styles when min style file is created
    .pipe(notify({ message: 'Styles task complete', onLast: true }));
});

gulp.task('stylesAddons', function() {
    return gulp.src([
        source + 'sass/**/navigation-offcanvas.scss',
        source + 'sass/**/flexnav.scss'
    ])
        .pipe(plumber({
            errorHandler: function(err) {
                console.log(err);
                this.emit('end');
            }
        }))
        .pipe(sourcemaps.init())
        .pipe(sass({
            sourceComments: 'map',
            sourceMap: 'sass',
            outputStyle: 'compressed'
        }).on('error', sass.logError))
        .pipe(autoprefixer(
            'last 2 version',
            'safari 5', 'ie 8',
            'ie 9',
            'opera 12.1',
            'ios 6',
            'android 4'
        ))
        .pipe(sourcemaps.write('../maps'))
        .pipe(plumber.stop())
        .pipe(replace('@charset "UTF-8";', '')) // Removes UTF-8 Encoding string atop CSS files
        .pipe(gulp.dest(source + 'css'))
        .pipe(filter('**/*.css')) // Filtering stream to only css files
        .pipe(reload({stream:true})) // Inject Styles when style file is created
        .pipe(rename({ suffix: '-min' }))
        .pipe(minifycss({
            maxLineLen: 80
        }))
        .pipe(gulp.dest('../css'))
        .pipe(reload({stream:true})) // Inject Styles when min style file is created
        .pipe(notify({ message: 'Styles task complete', onLast: true }));
});
/******************************************************************************
| >   JS TASKS
******************************************************************************/

gulp.task('js', function() {
  return gulp.src([source + 'js/app/**/*.js'])
    .pipe(concat('development.js'))
    .pipe(gulp.dest(source + 'js'))
    .pipe(rename({
      basename: 'production',
      suffix: '-min'
    }))
    .pipe(uglify())
    .pipe(gulp.dest(source + 'js/'))
    .pipe(notify({ message: 'Scripts task complete', onLast: true }));
});

/**
 * jsHint Tasks
 *
 * Scan our own JS code excluding vendor JS libraries and perform jsHint task.
 */
gulp.task('jsHint', function() {
  return gulp.src([source + 'js/app/**/*.js'])
    .pipe(jshint('.jshintrc'))
    .pipe(jshint.reporter('default'))
    .pipe(notify({ message: 'jsHint task complete', onLast: true }));
});

/**
 * Images
 *
 * Look at src/images, optimize the images and send them to the appropriate place
*/
gulp.task('images', function() {
  return gulp.src([source + 'img/raw/**/*.{png,jpg,gif}'])
    .pipe(imagemin({ optimizationLevel: 5, progressive: true, interlaced: true }))
    .pipe(gulp.dest(source + 'img/'))
    .pipe(notify({ message: 'images task complete', onLast: true }));
});

/**
 * Clean
 *
 * Being a little overzealous, but we're cleaning out the build folder, codekit-cache directory and annoying DS_Store files and Also
 * clearing out unoptimized image files in zip as those will have been moved and optimized
*/

gulp.task('cleanup', function(cb) {
  return del(['**/build', './assets/bower_components', './library/vendors/composer', '**/.sass-cache', '**/.codekit-cache', '**/.DS_Store', '!node_modules/**'], cb);
});

gulp.task('cleanupFinal', function(cb) {
  return del(['**/build', './assets/bower_components', '**/.sass-cache', '**/.codekit-cache', '**/.DS_Store', '!node_modules/**'], cb);
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
  return gulp.src(themeBuild)
    .pipe(gulp.dest(build))
    .pipe(notify({ message: 'Moving files complete', onLast: true }));
});

// Copy Assets to Build
gulp.task('buildAssets', function() {
  return gulp.src([source + '**', source + 'js/**/*.js'])
    .pipe(gulp.dest(build + '/assets'))
    .pipe(notify({ message: 'Copy of Assets directory complete', onLast: true }));
});

// Copy Library to Build
gulp.task('buildLibrary', function() {
  return gulp.src(['./library/**'])
    .pipe(gulp.dest(build + 'library'))
    .pipe(notify({ message: 'Copy of Library directory complete', onLast: true }));
});

/**
 * Zipping build directory for distribution
 *
 * Taking the build folder, which has been cleaned, containing optimized files and zipping it up to send out as an installable theme
*/
gulp.task('buildZip', function() {
  return gulp.src([build + '/**/', './.jshintrc', './.bowerrc', './.gitignore'])
    .pipe(zip(project + '.zip'))
    .pipe(gulp.dest('./'))
    .pipe(notify({ message: 'Zip task complete', onLast: true }));
});

/**
 * Images
 *
 * Look at src/images, optimize the images and send them to the appropriate place
*/
gulp.task('buildImages', function() {
  return gulp.src([source + 'assets/img/**/*', '!assets/images/originals/**'])

    // .pipe(plugins.cache(plugins.imagemin({ optimizationLevel: 7, progressive: true, interlaced: true })))
    .pipe(gulp.dest(build + 'assets/img/'))
    .pipe(plugins.notify({ message: 'Images task complete', onLast: true }));
});

// Package Distributable Theme
gulp.task('build', function(cb) {
  runSequence('styles', 'cleanup', 'js', 'buildPhp', 'buildLibrary', 'buildAssets', 'buildImages', 'buildZip', 'cleanupFinal', cb);
});

/**
 * "Sniff" the PHP to check
 * against WordPress coding standards.
 */
var php_files = ['**/*.php','!library/**','!vendor/**','!node_modules/**'];
gulp.task('php', function () {
  return gulp.src(php_files)
    // Validate files using PHP Code Sniffer
    .pipe(phpcs({
      bin: './vendor/bin/phpcs',
      standard: 'WordPress-Core'
    }))
    // Log all problems that was found
    .pipe(phpcs.reporter('log'));
});

/**
 * Holds all the test tasks.
 */
gulp.task('test',['php','jsHint']);

/******************************************************************************
| >   WATCH TASKS
******************************************************************************/

// Watch Task
gulp.task('default', ['styles', 'js', 'images', 'browser-sync', 'test'], function() {
  gulp.watch(source + 'sass/**/*.scss', ['styles']);
  gulp.watch(source + 'sass/**/*.scss', ['stylesAddons']);
  gulp.watch(source + 'js/app/**/*.js', ['js', browserSync.reload]);
  gulp.watch(source + 'js/app/**/*.js', ['jsHint']);
  gulp.watch(source + 'img/**/*.{png,jpg,gif}', ['images']);
  gulp.watch(php_files, ['php']);
});
