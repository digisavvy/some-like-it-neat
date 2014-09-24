// Source; http://www.ataylor.me/code/tutorials/using-gulp-js-in-wordpress-development/

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
    cmq = require('gulp-combine-media-queries'),
    runSequence = require('gulp-run-sequence'),
    plugins     = require('gulp-load-plugins')({ camelize: true }),
    cache = require('gulp-cache');

//Set Source Files A comment test
var imgSrc = 'src/images/**/*.{png,jpg,jpeg,gif}',
    imgDest = 'assets/',
    cssSrc = 'src/sass/**/*.scss',
    cssDest = 'assets/css',
    fontSrc = 'src/fonts/**/*',
    fontDest = 'assets/fonts',
    jsMainSrc = 'src/js/**/*.js',
    jsDest = 'assets/js',
    phpSrc = ['**/*.php', !'vendors/**/*.php'];

// Browser Sync
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

// Styles
gulp.task('styles', function() {
  return gulp.src('src/sass/**/*.scss')
    .pipe(sass({ style: 'expanded', }))
    .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
    // Write style.css to root theme directory
    // .pipe(gulp.dest('./'))
    .pipe(rename({ suffix: '-min' }))
    .pipe(minifycss({keepBreaks:true}))
    .pipe(minifycss({ keepSpecialComments: 1 }))
    .pipe(reload({stream:true}))
    
    //Write minified file
    .pipe(gulp.dest(cssDest))
    //combine media queries
    .pipe(cmq())
    .pipe(notify({ message: 'Styles task complete' }));
});

// Scripts
gulp.task('scripts', function() {
  return gulp.src('src/js/**/*.js')
    // .pipe(jshint('.jshintrc'))
    // .pipe(jshint.reporter('default'))
    .pipe(concat('production.js'))
    .pipe(gulp.dest('assets/js'))
    .pipe(rename({ suffix: '-min' }))
    .pipe(uglify())
    .pipe(gulp.dest(jsDest))
    .pipe(notify({ message: 'Scripts task complete' }));
});

// Images
gulp.task('images', function() {
  return gulp.src('src/images/**/*')
	.pipe(plugins.cache(plugins.imagemin({ optimizationLevel: 7, progressive: true, interlaced: true })))
	.pipe(gulp.dest('assets/images'))
	.pipe(plugins.notify({ message: 'Images task complete' }));
});


//Fonts
gulp.task('fonts', function() {
    return gulp.src(fontSrc)
    //don't do anything to fonts, just save 'em
    .pipe(gulp.dest(fontDest));
});

// Clean
gulp.task('clean', function() {
  return gulp.src(['**/.codekit-cache','**/.DS_Store', 'src/images/*'], {read: false})
    .pipe(clean());
});

// Watch
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

// Default task
gulp.task('default', ['browser-sync'], function(cb) {
    // gulp.start('styles', 'scripts', 'images', 'clean');
    runSequence('styles', 'scripts', 'images', 'fonts', 'clean', cb);
    gulp.watch('src/sass/**/*.scss', ['styles']);
});

