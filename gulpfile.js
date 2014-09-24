// Project configuration
var project     = 'my-theme'
  build       = './build/',
  dist        = './dist/',
  source      = './src/', 	// 'source' instead of 'src' to avoid confusion with gulp.src
  bower       = './bower_components/';

// Load plugins 
var gulp = require('gulp'),
    browserSync = require('browser-sync'), // Asynchronous browser loading on .scss file changes
    reload      = browserSync.reload,
    sass = require('gulp-ruby-sass'), // Our Sass compiler
    autoprefixer = require('gulp-autoprefixer'), // Autoprefixing magic
    minifycss = require('gulp-minify-css'),
    jshint = require('gulp-jshint'),
    uglify = require('gulp-uglify'),
    imagemin = require('gulp-imagemin'),
    rename = require('gulp-rename'),
    clean = require('gulp-clean'),
    concat = require('gulp-concat'),
    notify = require('gulp-notify'),
    cmq = require('gulp-combine-media-queries'),
    runSequence = require('gulp-run-sequence'),
    plugins     = require('gulp-load-plugins')({ camelize: true }),
    ignore = require('gulp-ignore'), // Helps with ignoring files and directories in our run tasks
    rimraf = require('gulp-rimraf'), // Helps with removing files and directories in our run tasks
    zip = require('gulp-zip'), // Using to zip up our packaged theme into a tasty zip file that can be installed in WordPress!
    cache = require('gulp-cache');

/**
 * Browser Sync
 *
 * The 'cherry on top!' Asynchronous browser syncing of assets across multiple devices!! Watches for changes to js, image and php files
 * Although, I think this is redundant, since we have a watch task that does this already.
*/
gulp.task('browser-sync', function() {
    var files = [
    //only minified JS
    'src/js/**/*.js',
    //only minified CSS
    // 'src/sass/**/*.scss',
    //all images
    'src/images/**/*.{png,jpg,jpeg,gif}',
    //all php files
    '**/*.php'
    ];
    browserSync.init(files, {
        // files: ["./**/*.php", "./**./*.html"],
        proxy: "somelikeitneat.dev"
    });

});

/**
 * Styles
 *
 * Looking at src/sass and compiling the files into Expanded format, Autoprefixing and sending the files to the build folder
*/
gulp.task('styles', function() {
  return gulp.src('src/sass/**/*.scss')
    .pipe(sass({ style: 'expanded', }))
    .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
    // Write style.css to root theme directory
    .pipe(gulp.dest('build'))
    .pipe(rename({ suffix: '-min' }))
    .pipe(minifycss({keepBreaks:true}))
    .pipe(minifycss({ keepSpecialComments: 1 }))
    .pipe(reload({stream:true}))
    
    //Write minified file
    .pipe(gulp.dest(build))
    //combine media queries
    .pipe(cmq())
    .pipe(notify({ message: 'Styles task complete' }));
});

/**
 * Scripts
 *
 * Look at src/js and concatenate those files, send them to assets/js where we then minimize the concatenated file.
*/
gulp.task('scripts', function() {
  return gulp.src('src/js/**/*.js')
    // .pipe(jshint('.jshintrc'))
    // .pipe(jshint.reporter('default'))
    .pipe(concat('production.js'))
    .pipe(gulp.dest('assets/js'))
    .pipe(rename({ suffix: '-min' }))
    .pipe(uglify())
    .pipe(gulp.dest(build+'assets/js/'))
    .pipe(notify({ message: 'Scripts task complete' }));
});

/**
 * Images
 *
 * Look at src/images, optimize the images and send them to the appropriate place
*/
gulp.task('images', function() {
  return gulp.src('src/images/**/*')
	.pipe(plugins.cache(plugins.imagemin({ optimizationLevel: 7, progressive: true, interlaced: true })))
	.pipe(gulp.dest(build+'assets/images/'))
	.pipe(plugins.notify({ message: 'Images task complete' }));
});

/**
 * Fonts
 *
 * I don't even know why the fuck this is here... Might as well be "cute" everywhere...
*/
gulp.task('fonts', function() {
    return gulp.src(source+'fonts/**')
    //don't do anything to fonts, just save 'em
    .pipe(gulp.dest(build+'fonts/'))
    .pipe(notify({ message: 'Fonts task complete' }));
});

/**
 * Clean
 *
 * Being a little overzealous, but we're cleaning out the build folder, codekit-cache directory and annoying DS_Store files and Also
 * clearing out unoptimized image files in zip as those will have been moved and optimized
*/
gulp.task('clean', function() {
  return gulp.src(['**/build','**/.codekit-cache','**/.DS_Store', 'src/images/*'], {read: false})
    .pipe(clean())
    .pipe(notify({ message: 'Clean task complete' }));
});

/**
 * Zipping build directory for distribution
 *
 * Taking the build folder, which has been cleaned, containing optimized files and zipping it up to send out as an installable theme
*/
gulp.task('zip', function () {
    return gulp.src(build+'/**/')
        .pipe(zip(project+'.zip'))
        .pipe(gulp.dest('./'))
        .pipe(notify({ message: 'Zip task complete' }));
});

/**
 * Watch
 *
 * Redundancy going on here, for sure. 
 * TO-DO: Need to double check that last watch task.
*/
gulp.task('watch', function() {

  // Watch .scss files
  gulp.watch('src/sass/**/*.scss', ['styles']);

  // Watch .js files
  gulp.watch('src/js/**/*.js', ['scripts']);

  // Watch image files
  gulp.watch('src/images/**/*.{png,jpg,jpeg,gif}', ['images']);

  // Watch any files in src/, reload on change
  gulp.watch(['src/**']).on('change', function(file) {
    server.changed(file.path);
  });

});

// ==== FILE AND DIRECTORY MOVING ==== //


/**
 * Copy PHP source files to the build directory
 *
 * First, we're moving PHP files to the build folder for redistribution. Also we're excluding the library, build and src directories. Why?
 * Excluding build prevents recursive copying and Inception levels of bullshit. We exclude library because there are certain non-php files
 * there that need to get moved as well. So I put the library directory into its own task. Excluding src because, well, we don't want to
 * distribute uniminified/unoptimized files. And, uh, grabbing screenshot.png cause I'm janky like that!
*/
gulp.task('php', function() {
  return gulp.src(['**/*.php', './screenshot.png','!./build/**','!./library/**','!./src/**']) 
  .pipe(gulp.dest(build))
  .pipe(notify({ message: 'Moving PHP files complete' }));
});

// Copy Library to Build
gulp.task('library', function() {
  return gulp.src(['./library/**'])
  .pipe(gulp.dest(build+'library'))
  .pipe(notify({ message: 'Copy of Library directory complete' }));
});

// ==== TASKS ==== //

// Default task
gulp.task('default', ['browser-sync'], function(cb) {
    // gulp.start('styles', 'scripts', 'images', 'clean');
    runSequence('styles', 'scripts', 'images', 'fonts', 'clean', cb);
    gulp.watch('src/sass/**/*.scss', ['styles']);
});

// Package Distributable Theme
gulp.task('package', function(cb) {
    // gulp.start('styles', 'scripts', 'images', 'clean');
    runSequence('clean', 'php', 'library', 'styles', 'scripts', 'fonts', 'zip', cb);
});

