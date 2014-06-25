/**
 * Some Like it Neat Gruntfile
 * http://alexhasnicehair.com
 *
 * @author Alex Vasquez
 */

'use strict';

/**
 * Grunt Module
 */
module.exports = function(grunt) {
	/**
	 * Load Grunt plugins
	 */
	require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

	/**
	 * Configuration
	 */
	grunt.initConfig({
		/**
		 * Get package meta data
		 */
		pkg: grunt.file.readJSON('package.json'),
		/**
		 * Bower Copy
		 */
		bowercopy: {
			options: {
				srcPrefix: 'bower_components'
			},
			scss: {
				options: {
					destPrefix: 'assets/scss/vendor'
				},
				files: {
					'neat': 'neat/app/assets/stylesheets',
					'bourbon': 'bourbon/dist',
					'normalize': 'modularized-normalize-scss/*.scss',
					'normalize/base': 'modularized-normalize-scss/base',
					'normalize/embed': 'modularized-normalize-scss/embed',
					'normalize/forms': 'modularized-normalize-scss/forms',
					'normalize/grouping': 'modularized-normalize-scss/grouping',
					'normalize/html5': 'modularized-normalize-scss/html5',
					'normalize/links': 'modularized-normalize-scss/links',
					'normalize/tables': 'modularized-normalize-scss/tables',
					'normalize/text-level': 'modularized-normalize-scss/text-level'
				}
			}
		},
		/**
		 * Sass
		 */
		sass: {
			dist: {
				options: {
					style: 'expanded',
					lineNumbers: false,
					debugInfo: false,
					compass: false
				},
				files: {
					'style.css' : 'assets/scss/style.scss'
				}
			}
		},
		/**
		 * Watch
		 */
		watch: {
			sass: {
				files: [
					'assets/scss/*.scss',
					'assets/scss/**/*.scss',
					'assets/scss/**/**/*.scss'
				],
				tasks: ['sass']
			}
		}
	});

	/**
	 * Default task
	 * Run `grunt` on the command line
	 */
	grunt.registerTask('default', [
		'bowercopy',
		'sass',
		'watch'
	]);
};
