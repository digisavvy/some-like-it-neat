// Import required packages.
const { mix }           = require( 'laravel-mix' );
const ImageminPlugin    = require( 'imagemin-webpack-plugin' ).default;
const CopyWebpackPlugin = require( 'copy-webpack-plugin' );
const imageminMozjpeg   = require( 'imagemin-mozjpeg' );
const rimraf            = require( 'rimraf' );
const zipFolder 		= require('folder-zip-sync');


// Project specific naming. Change extension to suit your local setup
let project = 'slintheme';
let url = project+'.site';
let themeBundle = 'release/'+project+'.zip';

// Define assets directory for source and theme bundle distribution
const assets = 'assets/';
const dist = 'dist/';
const bundlePath = dist;

/*
 * -----------------------------------------------------------------------------
 * Theme Bundle Process
 * -----------------------------------------------------------------------------
 * Creates a bundle of the production-ready theme with only the files and
 * folders needed for uploading to a site or zipping. Edit the `files` or
 * `folders` variables if you need to change something.
 * -----------------------------------------------------------------------------
 */

if ( process.env.bundle ) {

    // Theme root-level files to include.
	let files = [
        '.gitignore',
        'CHANGELOG.md',
        'composer.json',
        'composer.phar',
        'CONTRIBUTING.md',
        'license.txt',
        'package.json',
        'README.md',
        'screenshot.png',
        'style.css'
	];

	// Folders to include.
	let folders = [
		assets,
		'library',
        'page-templates',
        'page-templates/template-parts'
	];

    // Delete the previous bundle to start clean.
    rimraf.sync( bundlePath );

    // Copy theme-root-level php files
	mix.copy('*.php', bundlePath);

	// Loop through the root files and copy them over.
	files.forEach( file => {
        mix.copy( file, `${bundlePath}/${file}` );
	} );

	// Loop through the folders and copy them over.
	folders.forEach( folder => {
		mix.copyDirectory( folder, `${bundlePath}/${folder}` );
	} );

	// Bail early because we don't need to do anything else after this point.
	// Everything else following below is for the build process.
	return;
}

// Sass configuration.
var sassConfig = {
	outputStyle : 'expanded',
	indentType  : 'tab',
	indentWidth : 1
};

/*
 * Compile source js and sass assets.
 *
 * @link https://laravel.com/docs/5.6/mix#working-with-stylesheets
 */
mix.setPublicPath('./')

    // Compile Sass
    .sass(assets+'/styles/style.scss', assets+'/css/', sassConfig)
    .sass(assets+'/styles/editor.scss', assets+'/css/', sassConfig)
	.sass(assets+'/styles/vendor/flexnav.scss', assets+'/css/vendor', sassConfig)
	.sass(assets+'/styles/vendor/headroom.scss', assets+'/css/vendor', sassConfig)
    .sass(assets+'/styles/layouts/navigation-offcanvas.scss', assets+'/css/layouts', sassConfig)

    // Compile js
    .js( assets+'/js/app/*.js', assets+'/js/app.js' )

    // Browser css injection and reloading
    .browserSync({
        proxy: url,
        host: url,
        open: 'external',
        files : [
            '**/*.{jpg,jpeg,png,gif,svg,eot,ttf,woff,woff2}',
            'library/**/*.php',
            '**/*.php',
            assets+'css/**/*.css'
        ]
    });

/*
 * Set Laravel Mix options.
 *
 * @link https://laravel.com/docs/5.6/mix#postcss
 * @link https://laravel.com/docs/5.6/mix#url-processing
 */
mix.options( {
	postCss        : [ require( 'postcss-preset-env' )() ],
	processCssUrls : false
} );

/*
 * Builds sources maps for assets.
 *
 * @link https://laravel.com/docs/5.6/mix#css-source-maps
 */
mix.sourceMaps();

/*
 * Versioning and cache busting. Append a unique hash for production assets. If
 * you only want versioned assets in production, do a conditional check for
 * `mix.inProduction()`.
 *
 * @link https://laravel.com/docs/5.6/mix#versioning-and-cache-busting
 */
mix.version();

/*
 * Ripped straight from the repos of Justin Tadlock
 * @link https://github.com/justintadlock/mythic/blob/master/webpack.mix.js
 * 
 * Add custom Webpack configuration.
 *
 * Laravel Mix doesn't currently minimize images while using its `.copy()`
 * function, so we're using the `CopyWebpackPlugin` for processing and copying
 * images into the distribution folder.
 *
 * @link https://laravel.com/docs/5.6/mix#custom-webpack-configuration
 * @link https://webpack.js.org/configuration/
 */
mix.webpackConfig( {
	stats       : 'minimal',
	devtool     : mix.inProduction() ? false : 'source-map',
	performance : { hints  : false    },
	externals   : { jquery : 'jQuery' },
	plugins     : [
		// @link https://github.com/webpack-contrib/copy-webpack-plugin
		new CopyWebpackPlugin( [
			{ from : assets+'/img',   to : assets+'/img'   },
			{ from : assets+'/svg',   to : assets+'/svg'   },
			{ from : assets+'/fonts', to : assets+'/fonts' }
		] ),
		// @link https://github.com/Klathmon/imagemin-webpack-plugin
		new ImageminPlugin( {
			test     : /\.(jpe?g|png|gif|svg)$/i,
			disable  : process.env.NODE_ENV !== 'production',
			optipng  : { optimizationLevel : 3 },
			gifsicle : { optimizationLevel : 3 },
			pngquant : {
				quality : '65-90',
				speed   : 4
			},
			svgo : {
				plugins : [
					{ cleanupIDs                : false },
					{ removeViewBox             : false },
					{ removeUnknownsAndDefaults : false }
				]
			},
			plugins : [
				// @link https://github.com/imagemin/imagemin-mozjpeg
				imageminMozjpeg( { quality : 75 } )
			]
		} )
	]
} );

// While in production
if (mix.inProduction()) {
	zipFolder( bundlePath, project+'.zip' );
	mix.copy(project+'.zip', themeBundle);
	// Delete the previous bundle to start clean.
    // rimraf.sync( bundlePath );
}