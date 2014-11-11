/**
 * Project Setup
 *
 * Setting up variables for project name and directories
*/

// Project configuration
var project     = 'somelikeitneat', // Optional - Use your own project name here...
	build       = './build/', // Files that you want to package into a zip go here
	assets      = './assets/', 	// Your main project assets and naming 'source' instead of 'src' to avoid confusion with gulp.src
	bower       = './bower_components/'; // Not truly using this yet, more or less playing right now. TO-DO Place in Dev branch

// Load plugins
var gulp 			= require('gulp'),
	browserSync 	= require('browser-sync'), // Asynchronous browser loading on .scss file changes
	reload      		= browserSync.reload,
	autoprefixer 	= require('gulp-autoprefixer'), // Autoprefixing magic
	minifycss 		= require('gulp-minify-css'),
	jshint 			= require('gulp-jshint'),
	uglify 			= require('gulp-uglify'),
	imagemin 		= require('gulp-imagemin'),
	newer 			= require('gulp-newer'),
	rename 		= require('gulp-rename'),
	concat 			= require('gulp-concat'),
	notify 			= require('gulp-notify'),
	cmq 			= require('gulp-combine-media-queries'),
	runSequence 	= require('gulp-run-sequence'),
	sass 			= require('gulp-ruby-sass'), // Our Sass compiler
	plugins     		= require('gulp-load-plugins')({ camelize: true }),
	ignore 			= require('gulp-ignore'), // Helps with ignoring files and directories in our run tasks
	rimraf 			= require('gulp-rimraf'), // Helps with removing files and directories in our run tasks
	zip 				= require('gulp-zip'), // Using to zip up our packaged theme into a tasty zip file that can be installed in WordPress!
	plumber 		= require('gulp-plumber'), // Helps prevent stream crashing on errors
	pipe 			= require('gulp-coffee'),
	requireDir 		= require('require-dir'),
	browserify   	= require('browserify'),
	watchify     	= require('watchify'),
	source       		= require('vinyl-source-stream'),
	cache 			= require('gulp-cache');
// ==== Packaging Tasks, File/Directory Moving etc. ==== //

/**
 * Images
 *
 * Look at src/images, optimize the images and send them to the appropriate place
*/
gulp.task('buildImages', function() {
	return gulp.src(assets+'img/**/*', '!assets/images/originals/**')
		// .pipe(plugins.cache(plugins.imagemin({ optimizationLevel: 7, progressive: true, interlaced: true })))
		.pipe(gulp.dest(build+'assets/img/'))
		.pipe(plugins.notify({ message: 'Images task complete' }));
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
		.pipe(notify({ message: 'Moving files complete' }));
});

// Copy Library to Build
gulp.task('buildAssets', function() {
	return gulp.src([assets+'**', assets+'js/production.js'])
		.pipe(gulp.dest(build+'/assets'))
		.pipe(notify({ message: 'Copy of Assets directory complete' }));
});

// Copy Library to Build
gulp.task('buildLibrary', function() {
	return gulp.src(['./library/**'])
		.pipe(gulp.dest(build+'library'))
		.pipe(notify({ message: 'Copy of Library directory complete' }));
});

/**
 * Zipping build directory for distribution
 *
 * Taking the build folder, which has been cleaned, containing optimized files and zipping it up to send out as an installable theme
*/
gulp.task('buildZip', function () {
	return gulp.src(build+'/**/')
		.pipe(zip(project+'.zip'))
		.pipe(gulp.dest('./'))
		.pipe(notify({ message: 'Zip task complete' }));
});

// Package Distributable Theme
gulp.task('build', function(cb) {
		runSequence('cleanup', 'styles', 'js', 'buildPhp', 'buildLibrary', 'buildAssets', 'buildImages', 'buildZip','cleanup', cb);
});

