module.exports = function (grunt) {
  "use strict";

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    uglify: {
      build: {
        src: ['js/lib/*.js', 'js/global.js'],
        dest: 'js/global.min.js'
      }
    },
    sass: {
      dist: {
        options: {
          style: 'compact',
        },
        files: {
          'public/css/style.css': 'sass/style.scss',
        }
      }
    },
    watch: {
      css: {
        files: 'sass/*.scss',
        tasks: ['sass'],
        options: {
          livereload: true
        }
      },
      js: {
        files: ['js/lib/*.js', 'js/global.js'],
        tasks: ['uglify'],
        options: {
          livereload: true
        }
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-uglify');

  grunt.registerTask('default', ['sass', 'uglify']);
};