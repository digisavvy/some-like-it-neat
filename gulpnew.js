// Load plugins
var gulp = require('gulp'),
sass = require('gulp-sass'),
minifyCss = require("gulp-minify-css"),
autoprefixer = require("gulp-autoprefixer"),
imagemin = require('gulp-imagemin'),
notify = require("gulp-notify"),
rename = require("gulp-rename"),
cmq = require('gulp-combine-media-queries'),
uglify = require('gulp-uglify'),
runSequence = require('gulp-run-sequence'),
clean = require('gulp-clean'),
cache = require('gulp-cache'),
browserSync = require('browser-sync'),
reload = browserSync.reload;

//Error Handler
var handleErrors = function() {
    // Send error to notification center with gulp-notify
    notify.onError({
    title: "Compile Error",
    message: "<%= error.message %>"
    }).apply(this, arguments);

    // Keep gulp from hanging on this task
    this.emit('end');
};

//Set Source Files
var imgSrc = 'src/images/**/*.{png,jpg,jpeg,gif}',
imgDest = 'assets/images',
cssSrc = 'src/scss/**/*.scss',
cssDest = 'assets/css',
fontSrc = 'src/fonts/**/*',
fontDest = 'assets/fonts',
jsMainSrc = 'src/js/main.js',
jsVendorSrc = 'src/js/vendor/**/*.js',
jsVendorDest = 'assets/js/vendor',
jsDest = 'assets/js',
phpSrc = ['**/*.php', !'vendors/**/*.php'];

//Local URL
var localURL = 'http://localhost/MY-PROJECT'

//Sass
gulp.task('sass', function() {
return gulp.src(cssSrc)
    .pipe(sass({
        //define realtive image path for "image-url"
        imagePath: '../images'
    }))
    //send SASS errors to console
    .on('error', handleErrors)
    //add browser prefixes
    .pipe(autoprefixer())
    //Write human readable file
    .pipe(gulp.dest(cssDest))
    //combine media queries
    .pipe(cmq())
    //minify css
    .pipe(minifyCss({ keepSpecialComments: 1 }))
    //add "-min"
    .pipe(rename({suffix: "-min"}))
    //save minified file
    .pipe(gulp.dest(cssDest));
});

//Images
gulp.task('images', function() {
    return gulp.src(imgSrc)
    //use cache to only target new/changed files
    //then optimize the images
    .pipe(cache(imagemin({
        progressive: true,
        interlaced: true
    })))
    //save optimized image files
    .pipe(gulp.dest(imgDest));
});

//Images Build
gulp.task('buildImages', function() {
    return gulp.src(imgSrc)
    //don't use cache on build task since we are rebuilding all images
    //optimize images
    .pipe(imagemin({
        progressive: true,
        interlaced: true
    }))
    //save optimized image files
    .pipe(gulp.dest(imgDest));
});

//Fonts
gulp.task('fonts', function() {
    return gulp.src(fontSrc)
    //don't do anything to fonts, just save 'em
    .pipe(gulp.dest(fontDest));
});

//Vendor Scripts
gulp.task('vendorScripts', function() {
    //don't do anything to vendor, just save 'em
    //we will enqueue with WordPress
    return gulp.src(jsVendorSrc)
    .pipe(gulp.dest(jsVendorDest));
});

//Main Script
gulp.task('mainScript', function() {
    return gulp.src(jsMainSrc)
    //minfiy
    .pipe(uglify())
    //rename to "-min"
    .pipe(rename({suffix: "-min"}))
    //save
    .pipe(gulp.dest(jsDest));
});

//All Scripts
gulp.task('allScripts', function(cb) {
    runSequence('vendorScripts', 'mainScript', cb);
});

//Clean
gulp.task('buildClean', function() {
    //deletes everything in assets directory
    return gulp.src('assets').pipe(clean());
});

// Watch
gulp.task('watch', function() {

    // Watch main.js file and run mainScript task
    gulp.watch(jsMainSrc, ['mainScript']);

    // Watch .scss files and run sass task
    gulp.watch(cssSrc, ['sass']);

    // Watch image files and run image task
    gulp.watch(imgSrc, ['images']);

});

//BrowserSync
gulp.task('browserSync', function () {
    //declare files to watch
    //look for final files in build directory
    var files = [
    //only minified JS
    jsDest + '/**/*-min.js',
    //only minified CSS
    cssDest + '/**/*-min.css',
    //all images
    imgDest + '/**/*.{png,jpg,jpeg,gif}',
    //all php files
    '**/*.php'
    ];

    //initialize browsersync
    browserSync.init(files, {
    //browsersync can't run PHP so we proxy external local server
    proxy: localURL
    });
});

// Default task
gulp.task('default', function(cb) {
    runSequence(
    'buildClean',
    'images',
    'fonts',
    'allScripts',
    'sass',
    'browserSync',
    'watch',
    cb
    );
});

//Build Task
gulp.task('build', function(cb) {
  runSequence('buildClean', 'buildImages', 'fonts', 'allScripts', 'sass', cb);
});