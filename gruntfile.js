module.exports = function(grunt) {
	var pkg = grunt.file.readJSON('package.json');
	
	grunt.initConfig({ 
		pkg: pkg,
    a: 'assets/',
    b: 'assets/.tmp/',
		clean: {
			before: ['<%= b %>']
		},

		copy: {
			// General copying.
			before: {
				expand: true, 
				filter: 'isFile',
				cwd:	  '<%= a %>',
				src:    ['fonts/**'],
				dest:   '<%= b %>'
			},

			// Copy imgs after generated-sprites.
			imgs: {
				expand: true, 
				filter: 'isFile',
				cwd:	  '<%= a %>',
				src:    ['imgs/*'],
				dest:   '<%= b %>'
			}
		},

		uglify: {
      options: {
        beautify: false,
        mangle: true // was false
      },
      single: {
        files: {
          '<%= b %>js/main.js' : [
            '<%= a %>js/libs/*.js',
            '<%= a %>js/*.js',
            '!<%= a %>js/libs/.*.js'
          ]
        }
      }
    },

    sprite: {
      icons: {
        src: ['<%= a %>imgs/.icons/*.png'],
        dest: '<%= a %>imgs/spritesheet-icons.png',
        destCss: '<%= a %>css/mustache/generated-icons.scss',
        cssTemplate: '<%= a %>css/mustache/icons.mustache',
        retinaSrcFilter: ['<%= a %>imgs/.icons/*@2x.png', '<%= a %>imgs/.logos/*@2x.png'],
        retinaDest: '<%= a %>imgs/spritesheet-icons@2x.png',
        algorithm: 'binary-tree',
        engine: 'gmsmith'
      }/*,
      bgs: {
        src: '<%= a %>imgs/bgs/*',
        destImg: '<%= a %>imgs/spritesheet-bgs.jpg',
        destCSS: '<%= a %>css/mustache/generated-bgs.scss',
        cssTemplate: '<%= a %>css/mustache/bgs.mustache',
        algorithm: 'top-down',
        engine: 'gm',
        imgOpts: {
          quality: 95
        }
      }*/
    },

		compass: {
			assets: {
				options: {
					sourcemap: false,
					assetCacheBuster: true,
					sassDir: '<%= a %>css/mustache',
					cssDir:  '<%= a %>css/mustache'
        }
			},
	  },

    cssmin: {
      options: {},
      main: {
        files: {
          '<%= b %>css/main.css': [
            '<%= a %>css/*.css',
            '<%= a %>css/**/*.css',
            '!<%= a %>css/email.css',
            '!<%= a %>css/invoice1.css'
          ]
        }
      }
    },

    postcss: {
      options: {
        map: false,
        processors: [
          require('autoprefixer')({browsers: ['last 3 versions']})
        ]
      },
      dist: {
        src: '<%= b %>/css/main.css'
      }
    },

    replace: {
      buildtime: {
        src: ['package.json'],
        dest: 'package.json',
        replacements: [
          {from : /_buildtime"(\s*):(\s*)".*"/, to : '_buildtime"$1:$2"' + Date.now() + '"'}
        ]
      },
      css: {
        src: ['<%= b %>css/main.css'],
        dest: '<%= b %>css/main.css',
        replacements: [
          {from : '../../', to : '../'}
        ]
      }
    },

    tree: {
      assets: {
        dest: '<%= b %>tree.json',
        src:  [
          '<%= a %>**',//{<a>,<b>}

          // Removing . prefixes
          '!<%= a %>**/.*',
          '!<%= a %>**/.*/**',

          // Remove images
          '!<%= a %>uploads/**',
          '!<%= a %>**/generated**',

          // Remove css
          '!<%= a %>css/email.css',
          '!<%= a %>css/invoice1.css',
          '!<%= a %>css/mustache/**',
          
          // Adding back
          '<%= a %>**/generated*.css',
          '<%= b %>**',
        ]
      }
    },

    cacheBust: {
      main: {
        options: {
          assets: [
            // These files will be renamed!
            'js/*.js',
            'js/libs/*.js',
            'css/*.css',
            'css/**/*.css',
            'imgs/*.jpg',
            'imgs/*.png',
            'imgs/*.gif',
            'imgs/*.ico'
          ],
          baseDir: '<%= b %>',
          deleteOriginals: true,
          encoding: 'utf8',
          length: 8,
          separator: '.'
        },
        src: [
          // File that refers to above files and needs to be updated with the hashed name
          '<%= b %>tree.json',
          '<%= b %>css/*.css'
        ]
      }
    }
    
	});


  // Remove hashing on normal asset tree.
  grunt.registerTask('removeHash', function() {
    var fs = require('fs');

    // Config.
    var file = grunt.config.data.b + 'tree.json';
    var build = grunt.config.data.b;
    var regex = /(.*\/)(.*)\.([a-zA-Z0-9]{8})\.(.*)$/;

    var hashed, done = this.async();
    var tree  = JSON.parse(fs.readFileSync(file , "utf8"));

    function iterate(obj, path) {
      for (var prop in obj) {
        if (!obj.hasOwnProperty(prop)) continue;

        // Not under build directory.
        if (path + prop + '/' == build) continue;

        // Recurse directories
        if (typeof obj[prop] == "object") {
          iterate(obj[prop], path + prop + '/');
          continue;
        }

        // Filename hashed?
        if ((hashed = obj[prop].match(regex))) {
          console.log(hashed[1] + hashed[2] + "." + hashed[4]);
          obj[prop] = hashed[1] + hashed[2] + "." + hashed[4];
        }
      }
    }

    // Iterate through tree.
    iterate(tree, '');

    // Ouput to file.
    fs.writeFile(file, JSON.stringify(tree, null, 2), function() {
      console.log('Remove hashing on asset tree.');
      done();
    });
  });


	// Load modules.
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-spritesmith');
  grunt.loadNpmTasks("grunt-contrib-compass");
	grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-postcss');
  grunt.loadNpmTasks('grunt-text-replace');
  grunt.loadNpmTasks('grunt-tree');
  grunt.loadNpmTasks('grunt-cache-bust');

	// Grunt release.
	grunt.registerTask('default', [
		'clean:before',
		'copy:before',

		'uglify',
		'sprite',
		'copy:imgs',
		'compass',
		'cssmin',
    'postcss',
		'replace',

    'tree',
    'cacheBust',
    'removeHash',
	]);
};