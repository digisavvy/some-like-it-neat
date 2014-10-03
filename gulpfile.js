/**
 * Project Setup
 *
 * Setting up variables for project name and directories
*/

// Project configuration
var project     = 'somelikeitneat', // Optional - Use your own project name here...
	build       = './build/', // Files that you want to package into a zip go here
	source      = './assets/', 	// Your main project assets and naming 'source' instead of 'src' to avoid confusion with gulp.src
	bower       = './bower_components/'; // Not truly using this yet, more or less playing right now. TO-DO Place in Dev branch

// Load plugins 
var gulp = require('gulp'),
	browserSync = require('browser-sync'), // Asynchronous browser loading on .scss file changes
	reload      = browserSync.reload,
	autoprefixer = require('gulp-autoprefixer'), // Autoprefixing magic
	minifycss = require('gulp-minify-css'),
	jshint = require('gulp-jshint'),
	uglify = require('gulp-uglify'),
	imagemin = require('gulp-imagemin'),
	rename = require('gulp-rename'),
	concat = require('gulp-concat'),
	notify = require('gulp-notify'),
	cmq = require('gulp-combine-media-queries'),
	runSequence = require('gulp-run-sequence'),
	sass = require('gulp-ruby-sass'), // Our Sass compiler
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
		// Watch Source js files and reload on change
		source+'js/vendor/**/*.js',
		//all images — TO-DO: This isn't working
		source+'images/**/*.{png,jpg,jpeg,gif}',
		// Watch all PHP files and reload on change
		'**/*.php'
	];

	browserSync.init(files, {
	    proxy: project+".dev"
	});

});

/**
 * Styles
 *
 * Looking at src/sass and compiling the files into Expanded format, Autoprefixing and sending the files to the build folder
*/
gulp.task('styles', function() {
	return gulp.src(source+'sass/**/*.scss')
		.pipe(sass({ style: 'expanded', }))
		.pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
		// Write style.css to root theme directory
		.pipe(gulp.dest(source+'css'))
		//combine media queries
		.pipe(cmq())
		.pipe(rename({ suffix: '-min' }))
		.pipe(minifycss({keepBreaks:true}))
		.pipe(minifycss({ keepSpecialComments: 0 }))
		.pipe(reload({stream:true}))
		//Write minified file
		.pipe(gulp.dest(source+'css'))
		.pipe(notify({ message: 'Styles task complete' }));
});

/**
 * Scripts
 *
 * Look at src/js and concatenate those files, send them to assets/js where we then minimize the concatenated file.
*/
gulp.task('scripts', function() {
	return gulp.src(source+'js/vendor/**/*.js')
		// .pipe(jshint('.jshintrc')) // TO-DO: Reporting seems to be broken for js errors.
		// .pipe(jshint.reporter('default'))
		.pipe(concat('production.js'))
		.pipe(gulp.dest(source+'js'))
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
	return gulp.src(source+'images/originals/**/*')
		.pipe(plugins.cache(plugins.imagemin({ optimizationLevel: 7, progressive: true, interlaced: true })))
		.pipe(gulp.dest(source+'images/'))
		.pipe(plugins.notify({ message: 'Images task complete' }));
});

/**
 * Fonts
 *
 * I don't even know why the fuck this is here... Might as well be "cute" everywhere...
*/
gulp.task('fonts', function() {
	return gulp.src(source+'fonts/**')
		//don't do anything to fonts, just ship 'em
		.pipe(gulp.dest(build+'assets/fonts/'))
		.pipe(notify({ message: 'Fonts task complete' }));
});

/**
 * Clean
 *
 * Being a little overzealous, but we're cleaning out the build folder, codekit-cache directory and annoying DS_Store files and Also
 * clearing out unoptimized image files in zip as those will have been moved and optimized
*/
gulp.task('clean', function() {
	return gulp.src(['**/build','**/.sass-cache','**/.codekit-cache','**/.DS_Store', 'src/images/*'], {read: false})
		.pipe(clean())
		.pipe(notify({ message: 'Clean task complete' }));
});

/**
 * Watch
 *
 * Redundancy going on here, for sure. 
 * TO-DO: Need to double check that last watch task.
*/
gulp.task('watch', function() {

	// Watch .scss files
	gulp.watch(source+'sass/**/*.scss', ['styles']);

	// Watch .js files
	gulp.watch(source+'js/vendor/**/*.js', ['scripts']);

	// Watch image files
	gulp.watch(source+'images/originals/**/*', ['images']);

	// Watch any files in assets/, reload on change
	gulp.watch([source+'**']).on('change', function(file) {
		server.changed(file.path);
  });

});

// ==== Packaging Tasks, File/Directory Moving etc. ==== //

/**
 * Images
 *
 * Look at src/images, optimize the images and send them to the appropriate place
*/
gulp.task('buildImages', function() {
	return gulp.src(source+'images/**/*', '!assets/images/originals/**')
		// .pipe(plugins.cache(plugins.imagemin({ optimizationLevel: 7, progressive: true, interlaced: true })))
		.pipe(gulp.dest(build+'assets/images/'))
		.pipe(plugins.notify({ message: 'Images task complete' }));
});

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

// Copy Sass Files to Build
gulp.task('sass', function() {
	return gulp.src(['**/*.scss','!./build/**','!./library/**','!./src/**']) 
		.pipe(gulp.dest(build))
		.pipe(notify({ message: 'Moving Sass files complete' }));
});

// Copy CSS Files to Build
gulp.task('css', function() {
	return gulp.src([source+'css/**/*.css','!./build/**','!./library/**','!./src/**']) 
		.pipe(gulp.dest(build+'assets/css'))
		.pipe(notify({ message: 'Moving CSS files complete' }));
});

// Copy Library to Build
gulp.task('library', function() {
	return gulp.src(['./library/**'])
		.pipe(gulp.dest(build+'library'))
		.pipe(notify({ message: 'Copy of Library directory complete' }));
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

// ==== TASKS ==== //

// Default task
gulp.task('default', ['browser-sync'], function(cb) {
	// gulp.start('styles', 'scripts', 'images', 'clean');
	runSequence('styles', 'scripts', 'images', 'fonts', 'clean', cb);
	gulp.watch(source+'/sass/**/*.scss', ['styles']);
});

// Package Distributable Theme
gulp.task('package', function(cb) {
	// gulp.start('styles', 'scripts', 'images', 'clean');
	runSequence('clean', 'php', 'library', 'sass','css','styles', 'scripts', 'buildImages', 'fonts', 'zip','clean', cb);
});

