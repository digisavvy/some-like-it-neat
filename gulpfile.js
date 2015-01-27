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
var gulp 	= require('gulp'),
	browserSync	= require('browser-sync'), // Asynchronous browser loading on .scss file changes
	reload				= browserSync.reload,
	autoprefixer 	= require('gulp-autoprefixer'), // Autoprefixing magic
	minifycss 		= require('gulp-minify-css'),
	jshint 				= require('gulp-jshint'),
	uglify 				= require('gulp-uglify'),
	imagemin 			= require('gulp-imagemin'),
	newer 				= require('gulp-newer'),
	rename 				= require('gulp-rename'),
	concat 				= require('gulp-concat'),
	notify 				= require('gulp-notify'),
	cmq 					= require('gulp-combine-media-queries'),
	runSequence 	= require('gulp-run-sequence'),
	sass 					= require('gulp-ruby-sass'), // Our Sass compiler
	plugins 			= require('gulp-load-plugins')({ camelize: true }),
	ignore 				= require('gulp-ignore'), // Helps with ignoring files and directories in our run tasks
	rimraf 				= require('gulp-rimraf'), // Helps with removing files and directories in our run tasks
	zip 					= require('gulp-zip'), // Using to zip up our packaged theme into a tasty zip file that can be installed in WordPress!
	plumber 			= require('gulp-plumber'), // Helps prevent stream crashing on errors
	pipe 					= require('gulp-coffee'),
	cache 				= require('gulp-cache');

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
	    proxy: project+".dev"
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
		.pipe(sass({ style: 'expanded', }))
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
		.pipe(notify({ message: 'Styles task complete', onLast: true }))
});


/**
 * Scripts
 *
 * Look at src/js and concatenate those files, send them to assets/js where we then minimize the concatenated file.
*/
gulp.task('js', function() {
	return gulp.src([source+'js/vendor/**/*.js', source+'bower/**'])
		// .pipe(jshint('.jshintrc')) // TO-DO: Reporting seems to be broken for js errors.
		// .pipe(jshint.reporter('default'))
		.pipe(concat('production.js'))
		.pipe(gulp.dest(source+'js'))
		.pipe(rename({ suffix: '-min' }))
		.pipe(uglify())
		.pipe(gulp.dest(build+'assets/js/'))
		.pipe(notify({ message: 'Scripts task complete', onLast: true }));
});

/**
 * Images
 *
 * Look at src/images, optimize the images and send them to the appropriate place
*/
gulp.task('images', function() {

// Add the newer pipe to pass through newer images only
	return gulp.src([source+'img**/*.{png,jpg,gif}'])
		.pipe(newer(source+'img**/*.{png,jpg,gif}'))
		.pipe(imagemin({ optimizationLevel: 7, progressive: true, interlaced: true }))
		.pipe(gulp.dest(source));

});

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
    .pipe(notify({ message: 'Clean task complete', onLast: true }));
});
gulp.task('cleanupFinal', function() {
  return gulp.src(['**/build','**/.sass-cache','**/.codekit-cache','**/.DS_Store', 'src/images/*'], { read: false }) // much faster
    // .pipe(ignore('node_modules/**')) //Example of a directory to ignore
    .pipe(rimraf())
    .pipe(notify({ message: 'Build task complete', onLast: true }));
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

// Copy Library to Build
gulp.task('buildLibrary', function() {
	return gulp.src(['./library/**'])
		.pipe(gulp.dest(build+'library'))
		.pipe(notify({ message: 'Copy of Library directory complete', onLast: true }));
});

/**
 * Zipping build directory for distribution
 *
 * Taking the build folder, which has been cleaned, containing optimized files and zipping it up to send out as an installable theme
*/
gulp.task('buildZip', function () {
	return gulp.src([build+'/**/'])
		.pipe(zip(project+'.zip'))
		.pipe(gulp.dest('./'))
		.pipe(notify({ message: 'Zip task complete', onLast: true }));
});

/**
 * Images
 *
 * Look at src/images, optimize the images and send them to the appropriate place
*/
gulp.task('buildImages', function() {
	return gulp.src([source+'img/**/*', '!assets/images/originals/**'])
		// .pipe(plugins.cache(plugins.imagemin({ optimizationLevel: 7, progressive: true, interlaced: true })))
		.pipe(gulp.dest(build+'assets/img/'))
		.pipe(plugins.notify({ message: 'Images task complete', onLast: true }));
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
		runSequence('cleanup', 'styles', 'js', 'buildPhp', 'buildLibrary', 'buildAssets', 'buildImages', 'buildZip','cleanupFinal', cb);
});


// Watch Task
gulp.task('default', ['styles', 'browser-sync'], function () {
    gulp.watch(source+"sass/**/*.scss", ['styles']);
    gulp.watch(source+"js/vendor/**/*.js", ['js', browserSync.reload]);
});
