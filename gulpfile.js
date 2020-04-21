var browserSync = require("browser-sync").create();
var modRewrite = require('connect-modrewrite');
var gulp = require("gulp");
var php = require('gulp-connect-php');
var runSequence = require("run-sequence");

// starts a small php server
gulp.task('php', function() {
  php.server({
    base: './',
    port: 8000, 
    keepalive: true,
    // debug: true
    // stdio: ['ignore', 'ignore', process.stderr]
  });
});

// starts a small browsersync server that reloads
gulp.task("browserSync", ['php'], function() {
  browserSync.init({
    proxy: 'localhost:8000',
    baseDir: "./",
    open: true,
    notify: false,
    middleware: [
      modRewrite([
        '\.(css|map|js|jpg|jpeg|gif|png|svg|ico|ogg|mp4|mov|php)(\\?[0-9]+)?$ - [NC,L]'
      ])
    ]
  });
});

// public task::  default task
gulp.task("default", function(callback) {
  runSequence(["watch"], callback);
});

// public task::  watch for changes
gulp.task("watch", ["browserSync"], function() {
  //gulp.watch("assets/**").on("change", browserSync.reload);
  gulp.watch("*.php", browserSync.reload);
  gulp.watch(["site/**/*.php", "user/**/*.php"], browserSync.reload);
});
