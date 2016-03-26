module.exports = function(grunt) {

  //requires
  var path = require('path');

  //config
  var imageExtenstions = 'jpg|png|ico|gif|jpeg';
  var appDir = 'web/app';
  var vendorDir = appDir + '/vendor';
  var tmpDir = appDir + '/tmp';
  var appName = 'training';

  //matchers
  var matchers = {
    indexFiles: ['web/*.+(php|txt|ico|html)','web/.htaccess']
  };

  //requirejs helper object
  var rjs = {
    _files: [],
    _sfiles: [],
    _paths: [],
    _spaths: [],
    _pathMap: {},
    _spathMap: {},
    _shim: {},
    _signupshim: {},
    _getHandle: function(filepath) {
      return filepath.replace(appDir+'/','').replace('.js','');
    },
    generateFiles: function() {
      this._files = grunt.file.expand([appDir+'/**/*.js']);
      this._sfiles = grunt.file.expand([appDir+'/**/*.js']);
      //this._sfiles = grunt.file.expand([vendorDir+'/*.js',vendorDir+'/**/*.js',appDir+'/engine/engApp/*.js',appDir+'/engine/engApp/**/*.js',appDir+'/engine/engAuth/*.js',appDir+'/engine/engAuth/**/*.js',appDir+'/engine/engState/*.js',appDir+'/engine/engState/**/*.js',appDir+'/signup/*.js',appDir+'/signup/**/*.js',appDir+'*.js','!'+vendorDir+'/FileAPI/Grunfile.js']);
    },
    generatePaths: function() {
      if(!this._files.length || !this._sfiles.length) {
        this.generateFiles();
      }
      for (var i=0; i<this._files.length; i++) {
        if ( this._getHandle(this._files[i]).search(/FileAPI|^signup\/|signUpTemplate/) == -1)
        {
          this._paths.push(this._getHandle(this._files[i]));
          this._pathMap[this._getHandle(this._files[i])] =
              this._files[i].replace('.js','');
        }
      }
      appExcludeRegex = new RegExp("/FileAPI|^"+appName+"\\/|ngTemplateC/");
      for (var i=0; i<this._sfiles.length; i++) {
        if ( this._getHandle(this._sfiles[i]).search(appExcludeRegex) == -1) {
          this._spaths.push(this._getHandle(this._sfiles[i]));
          this._spathMap[this._getHandle(this._sfiles[i])] =
              this._sfiles[i].replace('.js', '');
        }
      }
    },
    generateShim: function() {

      appInit = appName+'/init';
      this._shim = {
        'vendor/jquery/jquery': ['vendor/requirejs/require'],
        'vendor/angular/angular': ['vendor/jquery/jquery','vendor/ng-file-upload-shim/angular-file-upload-shim'],
        'vendor/bootstrap/bootstrap': ['vendor/jquery/jquery'],        
        'vendor/highcharts/highcharts': ['vendor/jquery/jquery'],
        'vendor/angular-local-storage/angular-local-storage': ['vendor/angular/angular'],
        'vendor/angular-ui-router/angular-ui-router': ['vendor/angular/angular'],
        'vendor/angular-animate/angular-animate': ['vendor/angular/angular'],
        'vendor/angular-strap/angular-strap': ['vendor/angular/angular','vendor/bootstrap/bootstrap'],
        'vendor/angular-strap/angular-strap.tpl': ['vendor/angular-strap/angular-strap'],
        'engine/engApp/init': [
          'vendor/angular/angular',
          'vendor/bootstrap/bootstrap',
          'vendor/highcharts/highcharts',
          'vendor/angular-local-storage/angular-local-storage',
          'vendor/angular-ui-router/angular-ui-router',
          'vendor/angular-animate/angular-animate',
          'vendor/ng-file-upload/angular-file-upload',
          'vendor/angular-strap/angular-strap',
          'vendor/angular-strap/angular-strap.tpl'
        ],
        'ngTemplateCache': [appName+'/init']
      };
      this._shim[appInit] = [
        'vendor/angular/angular',
        'vendor/bootstrap/bootstrap',
        'vendor/highcharts/highcharts',
        'vendor/angular-local-storage/angular-local-storage',
        'vendor/angular-ui-router/angular-ui-router',
        'vendor/angular-animate/angular-animate',
        'vendor/angular-strap/angular-strap',
        'engine/engApp/init'
      ];
      this._signupshim = {
        'vendor/jquery/jquery': ['vendor/requirejs/require'],
        'vendor/angular/angular': ['vendor/jquery/jquery','vendor/ng-file-upload-shim/angular-file-upload-shim'],
        'vendor/bootstrap/bootstrap': ['vendor/jquery/jquery'],
        'vendor/highcharts/highcharts': ['vendor/jquery/jquery'],
        'vendor/angular-local-storage/angular-local-storage': ['vendor/angular/angular'],
        'vendor/angular-ui-router/angular-ui-router': ['vendor/angular/angular'],
        'vendor/angular-animate/angular-animate': ['vendor/angular/angular'],
        'vendor/angular-strap/angular-strap': ['vendor/angular/angular','vendor/bootstrap/bootstrap'],
        'vendor/angular-strap/angular-strap.tpl': ['vendor/angular-strap/angular-strap'],
        'engine/engApp/init': [
          'vendor/angular/angular',
          'vendor/bootstrap/bootstrap',
          'vendor/highcharts/highcharts',
          'vendor/angular-local-storage/angular-local-storage',
          'vendor/angular-ui-router/angular-ui-router',
          'vendor/angular-animate/angular-animate',
          'vendor/ng-file-upload/angular-file-upload',
          'vendor/angular-strap/angular-strap',
          'vendor/angular-strap/angular-strap.tpl'
        ],
        'signup/init': [
          'vendor/angular/angular',
          'vendor/bootstrap/bootstrap',
          'vendor/highcharts/highcharts',
          'vendor/angular-local-storage/angular-local-storage',
          'vendor/angular-ui-router/angular-ui-router',
          'vendor/angular-animate/angular-animate',
          'vendor/angular-strap/angular-strap',
          'engine/engApp/init'
        ],
        'signUpTemplateCache': ['signup/init']
      };

      var allNgFiles = grunt.file.expand([
        appDir+'/**/components/**/*.js',
        appDir+'/**/constants/**/*.js',
        appDir+'/**/filters/**/*.js',
        appDir+'/**/services/**/*.js',
        appDir+'/**/views/**/*.js'
      ]);
      var allSignUpNgFiles = grunt.file.expand([
        appDir+'/engine/engApp/components/**/*.js',
        appDir+'/engine/engApp/constants/**/*.js',
        appDir+'/engine/engApp/filters/**/*.js',
        appDir+'/engine/engApp/services/**/*.js',
        appDir+'/engine/engApp/views/**/*.js',
        appDir+'/engine/engAuth/components/**/*.js',
        appDir+'/engine/engAuth/constants/**/*.js',
        appDir+'/engine/engAuth/filters/**/*.js',
        appDir+'/engine/engAuth/services/**/*.js',
        appDir+'/engine/engAuth/views/**/*.js',
        appDir+'/engine/engState/components/**/*.js',
        appDir+'/engine/engState/constants/**/*.js',
        appDir+'/engine/engState/filters/**/*.js',
        appDir+'/engine/engState/services/**/*.js',
        appDir+'/engine/engState/views/**/*.js',
        appDir+'/signup/components/**/*.js',
        appDir+'/signup/constants/**/*.js',
        appDir+'/signup/filters/**/*.js',
        appDir+'/signup/services/**/*.js',
        appDir+'/signup/views/**/*.js'
      ]);

      for(var i=0; i<allNgFiles.length; i++) {
        if ( this._getHandle(allNgFiles[i]).search(/\/signup\//) == -1)
        {
          this._shim[this._getHandle(allNgFiles[i])] = [appName+'/init','engine/engApp/init'];
        }
      }
      for(var i=0; i<allSignUpNgFiles.length; i++) {
        this._signupshim[this._getHandle(allSignUpNgFiles[i])] = ['signup/init','engine/engApp/init'];
      }
    },
    writeFile: function() {
      //stole this pattern from the shimmer library - allows us to specify 
      //all of our info in the requirejs config file so that our config can 
      //be accurate as of the task execution (specifically file.expand resolution)
      var out = 
        '(function()\n' +
        '  {require({\n' + 
        '    include: '+JSON.stringify(this._paths).replace(/,/g,',\n')+',\n'+
        '    paths:'+JSON.stringify(this._pathMap).replace(/,/g,',\n')+',\n' +
        '    shim:'+JSON.stringify(this._shim).replace(/,/g,',\n')+'\n' +
        '  });\n' +
        '}).call(this);';
      var sout =
          '(function()\n' +
          '  {require({\n' +
          '    include: '+JSON.stringify(this._spaths).replace(/,/g,',\n')+',\n'+
          '    paths:'+JSON.stringify(this._spathMap).replace(/,/g,',\n')+',\n' +
          '    shim:'+JSON.stringify(this._signupshim).replace(/,/g,',\n')+'\n' +
          '  });\n' +
          '}).call(this);';

      grunt.file.write(path.resolve(__dirname,'require.main.js'),out);
      grunt.file.write(path.resolve(__dirname,'require.signup.js'),sout);
    }
  };

  //grunt task config
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    bower: {
      install: {
        options: {
          //verbose: true,
          targetDir: vendorDir,
          layout: 'byType'
        }
      }
    },    
    clean: {
      build: 'dist',
      buildArtifacts: [vendorDir,tmpDir,appDir+'/ngTemplateCache.js','require.main.js',appDir+'/signUpTemplateCache.js','require.signup.js'],
      debugHelpers: 'dist/web'
    },
    copy: {
      rules: {
        files: [{
          expand: true,
          cwd: 'web',
          src: 'rules/**',
          dest: 'dist'
        }]
      },
      bundles: {
        files: [{
          expand: true,
          cwd: 'web',
          src: 'bundles/**',
          dest: 'dist'
        }]
      },      
      indexFiles: {
        files: [{
          expand: true,
          src: matchers.indexFiles,
          flatten: true,
          dest: 'dist'
        }]
      },
      bootstrapFonts: {
        files: [{
          expand: true,
          cwd: 'web/app/vendor/bootstrap',
          src: ['glyphicons-halflings-regular.eot' ,'glyphicons-halflings-regular.svg' ,'glyphicons-halflings-regular.ttf', 'glyphicons-halflings-regular.woff'],
          dest: 'dist/fonts'
        }]
      },
      appFonts: {
        files: [{
                  expand: true,
                  cwd: 'web/fonts',
                  src: '**',
                  dest: 'dist/fonts'
                }]
      },
      lessSrc: {
        files: [{
          expand: true,
          cwd: 'web',
          src: 'less/**',
          dest: 'dist/web'
        }]
      },
      fileFlash: {
        files: [{
          expand: true,
          cwd: 'web/app/vendor',
          src: 'FileAPI/dist/**',
          dest: 'dist'
        }]
      },
      vendorCss: {
        files: [{
          expand: true,
          cwd: 'web',
          src: 'css/**',
          dest: 'dist'
        }]        
      },
    },
    cssmin: {
      build: {
        files: {
          'dist/css/kernel.css': ['dist/css/kernel.css'],
          'dist/css/animate/animate.css': ['dist/css/animate/animate.css'],
          'dist/css/angular-motion/angular-motion.css': ['dist/css/angular-motion/angular-motion.css']
        }
      }
    },
    imagemin: {
      build: {
         files: [{
          expand: true,          
          flatten: true,
          src: ['web/images/**.+('+imageExtenstions+')'],
          dest: 'dist/images'
        }]
      }
    },
    jshint: {
      files: [appDir+'/**/*.js', '!'+vendorDir+'/**'],
      options: {
        sub: true,
        laxcomma: true
      }
    },
    less: {
      build: {
        options: {
          paths: ['web/less'],
          //cleancss: true,
          compress: true,
          sourceMap: true,
          sourceMapFilename: 'dist/css/kernel.css.map',
          sourceMapURL: '/css/kernel.css.map'
        },
        files: {
          'dist/css/kernel.css': 'web/less/main.less',
          'dist/css/reports.css': 'web/less/reports.less'
        }
      }
    },
    ngtemplates: {
      build: {
        src: appDir+'/**/*.html',
        dest: appDir+'/ngTemplateCache.js',
        options: {
          module: appName.charAt(0).toUpperCase()+appName.slice(1)+'App',
          url: function(u) {
            return u.replace('web','');
          }
        }
      },
      signup: {
        src: appDir+'/**/*.html',
        dest: appDir+'/signUpTemplateCache.js',
        options: {
          module: 'SignupApp',
          url: function(u) {
            return u.replace('web','');
          }
        }
      }
    },
    requirejs: {
      build: {
        options: {
          mainConfigFile: 'require.main.js',
          optimize: 'uglify2',
          out: 'dist/kernel.js',
          preserveLicenseComments: false,
          generateSourceMaps: false,
          ascii_only: true,
          uglify2: {
            mangle: false,
            ascii_only: true,
            output: {
                  ascii_only: true
            }
          }
        }
      },      
      dev: {
        options: {
          mainConfigFile: 'require.main.js',
          optimize: 'none',
          out: 'dist/kernel.js',
          preserveLicenseComments: true,
          generateSourceMaps: true   
        }   
      },
      buildsignup: {
        options: {
          mainConfigFile: 'require.signup.js',
          optimize: 'uglify2',
          out: 'dist/signup.js',
          preserveLicenseComments: false,
          generateSourceMaps: false,
          ascii_only: true,
          uglify2: {
            mangle: false,
            ascii_only: true,
            output: {
              ascii_only: true
            }
          }
        }
      },
      devsignup: {
        options: {
          mainConfigFile: 'require.signup.js',
          optimize: 'none',
          out: 'dist/signup.js',
          preserveLicenseComments: true,
          generateSourceMaps: true
        }
      }
    },
    watch: {
      less: {
        files: ['web/less/**'],
        tasks: ['less','copy:lessSrc']
      },
      jsApp: {
        files: [appDir+'/**/*.js','!'+vendorDir+'/**','!web/app/ngTemplateCache.js','!web/app/signUpTemplateCache.js','!'+appDir+'/signup/**/*.js'],
        tasks: ['bower', 'ngtemplates', 'rjs:write', 'requirejs:dev', 'clean:buildArtifacts']
      },
      jsSApp: {
        files: [appDir+'/**/*.js','!'+vendorDir+'/**','!web/app/ngTemplateCache.js','!web/app/signUpTemplateCache.js','!'+appDir+'/'+appName+'/**/*.js'],
        tasks: ['bower', 'ngtemplates', 'rjs:write', 'requirejs:devsignup', 'clean:buildArtifacts']
      },
      ngTemplates: {
        files: [appDir+'/**/*.html','!'+appDir+'/signup/**/*.html'],
        tasks: ['bower', 'ngtemplates', 'rjs:write', 'requirejs:dev', 'clean:buildArtifacts']
      },
      ngSTemplates: {
        files: [appDir+'/**/*.html','!'+appDir+'/'+appName+'/**/*.html'],
        tasks: ['bower', 'ngtemplates', 'rjs:write', 'requirejs:devsignup', 'clean:buildArtifacts']
      },
      indexFiles: {
        files: matchers.indexFiles,
        tasks: ['copy:indexFiles']
      },
      images: {
        files: ['web/images/**'],
        tasks: ['imagemin']
      },
      rules: {
        files: ['web/rules/**'],
        tasks: ['copy']
      }
    },
  });

  
  //custom task to update rjs file/paths indexes 
  //  - needed so that this can be computed at the task runtime instead of
  //    on config/load.  The only way to guarantee run-time accuracy is to
  //    write a main file that gets loaded in via grunt's require task instead
  //    of using the built in options which are analyzed at grunt config init
  grunt.registerTask('rjs:write', function() {
    rjs.generateFiles();    
    rjs.generatePaths();
    rjs.generateShim(); 
    rjs.writeFile();
  });


  //load tasks dynamically
  require('load-grunt-tasks')(grunt);

  //register alias tasks
  grunt.registerTask('dist', ['clean:build', 'jshint', 'bower', 'copy', 'ngtemplates:build','ngtemplates:signup', 'imagemin', 'less', 'cssmin', 'rjs:write', 'requirejs:build','requirejs:buildsignup', 'clean:buildArtifacts', 'clean:debugHelpers']);
  grunt.registerTask('dev', ['clean:build','jshint', 'bower', 'copy', 'ngtemplates:build','ngtemplates:signup', 'imagemin', 'less', 'rjs:write', 'requirejs:dev','requirejs:devsignup', 'clean:buildArtifacts']);
  grunt.registerTask('dev:pre', ['clean:build','jshint', 'bower', 'copy', 'ngtemplates:build','ngtemplates:signup', 'imagemin', 'less', 'rjs:write']);
  grunt.registerTask('dev:app', ['clean:build','jshint', 'bower', 'copy', 'ngtemplates:build', 'imagemin', 'less', 'rjs:write', 'requirejs:dev', 'clean:buildArtifacts']);
  grunt.registerTask('dev:signup', ['clean:build','jshint', 'bower', 'copy','ngtemplates:signup', 'imagemin', 'less', 'rjs:write','requirejs:devsignup', 'clean:buildArtifacts']);
};
