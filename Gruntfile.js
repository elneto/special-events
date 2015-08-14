module.exports = function(grunt) {

  require('time-grunt')(grunt);

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    clean: ["assets/css/", "assets/fonts/", "assets/js/scripts.js",  "assets/js/scripts.min.js", "assets/img/"],
    copy: {
      main: {
        files: [
          // includes files within path
          {
            expand: true,
            cwd: 'src/font-awesome/fonts/',
            src: ['*'],
            dest: 'assets/fonts/',
            filter: 'isFile',
            flatten: 'true'
          }
        ]
      }
    },
    imagemin: {
      dynamic: {
        options: {
          optimizationLevel: 3
        },
        files: [{
          expand: true,
          cwd: 'img/',
          src: ['**/*.{png,jpg,gif}'],
          dest: 'assets/img/'
        }]
      }
    },
    sass: {
      dist: {
        options: {
          // loadPath: require('node-bourbon').with('other/path', 'another/path')
          // - or -
          loadPath: require('node-bourbon').includePaths
        },
        files: {
          'src/scss/style.css' : 'src/scss/style.scss',
          'src/scss/highcontrast.css' : 'src/scss/highcontrast.scss'
        }
      }
    },
    autoprefixer: {
      dist: {
        files: {
          'assets/css/style.css': 'src/scss/style.css',
          'assets/css/highcontrast.css': 'src/scss/highcontrast.css',
        }
      }
    },
    cssmin: {
      minify: {
        expand: true,
        cwd: 'assets/css',
        src: ['*.css', '!*.min.css'],
        dest: 'assets/css',
        ext: '.min.css'
      }
    },
    concat: {
      dist: {
        src: [
          'src/bootstrap-sass/js/affix.js',
          'src/bootstrap-sass/js/alert.js',
          'src/bootstrap-sass/js/button.js',
          'src/bootstrap-sass/js/carousel.js',
          'src/bootstrap-sass/js/collapse.js',
          'src/bootstrap-sass/js/dropdown.js',
          'src/bootstrap-sass/js/modal.js',
          'src/bootstrap-sass/js/tooltip.js',
          'src/bootstrap-sass/js/popover.js',
          'src/bootstrap-sass/js/scrollspy.js',
          'src/bootstrap-sass/js/tab.js',
          'src/bootstrap-sass/js/transition.js',
          'src/js/fitvids.js',
          'src/js/jquery.isotope.min.js',
          'src/js/owl.carousel.min.js',
          'src/js/scripts.js'
        ],
        dest: 'assets/js/scripts.js'
      }
    },
    uglify: {
      target: {
        // options: {
        //   beautify: true
        // },
        files: {
          'assets/js/scripts.min.js': ['assets/js/scripts.js']
        }
      }
    },
    validation: {
      options: {
        reset: grunt.option('reset') || true,
        stoponerror: false,
        relaxerror: ["Bad value X-UA-Compatible for attribute http-equiv on element meta.","document type does not allow element \"[A-Z]+\" here"]
      },
      your_target: {
          src: [
                '**/*.html',
                '!**/node_modules/**',
                '!src/**'
              ]
      }
    },
    phplint: {

        all: [
            '**/*.php',
              '!**/node_modules/**/*.php',
              '!src/**'
            ]
    },
    svgmin: {                       // Task
      options: {                  // Configuration that will be passed directly to SVGO
        plugins: [{
            removeViewBox: false
        }, {
            removeUselessStrokeAndFill: false
        }, {
            convertPathData: {
                straightCurves: false // advanced SVGO plugin option
            }
        }]
      },
      dist: {                     // Target
        files: [{               // Dictionary of files
            expand: true,       // Enable dynamic expansion.
            cwd: 'img/',     // Src matches are relative to this path.
            src: ['**/*.svg'],  // Actual pattern(s) to match.
            dest: 'assets/img/',       // Destination path prefix.
            ext: '.min.svg'     // Dest filepaths will have this extension.
            // ie: optimise img/src/branding/logo.svg and store it in img/branding/logo.min.svg
        }]
      }
    },
    watch: {
      css: {
        files: 'src/**/*.scss',
        tasks: ['sass'],
        options: {
          livereload: true,
      },
      },
      js: {
        files: 'src/**/*.js',
        tasks: ['concat']
      },
      html: {
        files: {
          src : [
                '**/*.html',
                  '!**/node_modules/**',
            '!src/**'
                ]
            },
        tasks: ['validation']
      },
      php: {
        files: '**/*.php',
        tasks: ['newer:phplint:all']
      },
      images: {
        files: 'img/**/*.{png,jpg,gif}',
        tasks: ['imagemin']
      },
      svg: {
        files: 'img/**/*.{svg}',
        tasks: ['svgmin']
      }
    },
    browser_sync: {
        files: {
            src :   [
                  'assets/css/*.css',
                  '**/*.html',
                  '**/*.php',
                  '!**/node_modules/**',
                  '!src/**'
                ]
        },
        options: {
            watchTask: true,
            ghostMode: {
                    clicks: true,
                    scroll: true,
                    links: true,
                    forms: true
                }
        },
    }
  });
  grunt.loadNpmTasks('grunt-newer');
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-imagemin');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-svgmin');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-autoprefixer');
  grunt.loadNpmTasks('grunt-phplint');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-html-validation');
  grunt.loadNpmTasks('grunt-browser-sync');

  grunt.registerTask('pro',['clean','sass','copy','concat','autoprefixer','uglify','imagemin','svgmin','cssmin']);
  grunt.registerTask('default',['browser_sync', 'watch']);
}