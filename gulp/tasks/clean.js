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
 * Clean
 *
 * Being a little overzealous, but we're cleaning out the build folder, codekit-cache directory and annoying DS_Store files and Also
 * clearing out unoptimized image files in zip as those will have been moved and optimized
*/
gulp.task('cleanup', function() {
  return gulp.src(['**/build','**/.sass-cache','**/.codekit-cache','**/.DS_Store', 'src/images/*'], { read: false }) // much faster
    // .pipe(ignore('node_modules/**')) //Example of a directory to ignore
    .pipe(rimraf())
    .pipe(notify({ message: 'Clean task complete' }));
});
