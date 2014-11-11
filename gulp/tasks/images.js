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
/**
 * Images
 *
 * Look at src/images, optimize the images and send them to the appropriate place
*/
gulp.task('images', function() {

// Add the newer pipe to pass through newer images only
	return gulp.src(assets+'img**/*.{png,jpg,gif}')
		.pipe(newer(assets+'img**/*.{png,jpg,gif}'))
		.pipe(imagemin({ optimizationLevel: 7, progressive: true, interlaced: true }))
		.pipe(gulp.dest(assets));

});
