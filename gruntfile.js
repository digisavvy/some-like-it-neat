module.exports = function(grunt) {

    // 1. All configuration goes here
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        concat: {
            dist: {
                src: [
                    'library/js/*.js', // All JS in the libs folder
                    'library/js/modernizr/*.js'  // This specific file
                ],
                dest: 'library/js/jsproduction.js',
            }
        },
        uglify: {
            build: {
                src: 'library/js/jsproduction.js',
                dest: 'library/js/production/production.min.js'
            }
        },
        imagemin: {
            dynamic: {
                files: [{
                    expand: true,
                    cwd: 'images/',
                    src: ['**/*.{png,jpg,gif}'],
                    dest: 'images/'
                }]
            }
        },
        sass: {
            dist: {
                options: {
                    style: 'compressed'
                },
                files: {
                    'style.css': 'sass/style.scss'
                }
            }
        },
        watch: {
            options: {
                livereload: true,
            },
            scripts: {
                files: ['library/js/*.js'],
                tasks: ['concat', 'uglify','imagemin'],
                options: {
                    spawn: false,
                },
            },
            css: {
                files: ['sass/*.scss'],
                tasks: ['sass'],
                options: {
                    spawn: false,
                }
            },
            images: {
              files: ['images/*.{png,jpg,gif}'],
              tasks: ['imagemin:single'],
              options: {
              spawn: false,
              }
            }
        }


    });

    // 3. Where we tell Grunt we plan to use this plug-in.
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-imagemin');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-sass');

    // 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
    grunt.registerTask('default', ['concat','uglify','imagemin','watch']);

};