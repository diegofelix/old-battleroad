var gulp = require('gulp');
var gutil = require('gulp-util');
var less = require('gulp-less');
var autoprefix = require('gulp-autoprefixer');
var minifyCSS = require('gulp-minify-css');
var exec = require('child_process').exec;
var sys = require('sys');

// Where do you store your less files?
var lessDir = 'app/assets/less';

// Which directory should less compile to?
var targetCSSDir = 'public/css';


// Compile less, autoprefix CSS3,
// and save to target CSS directory
gulp.task('css', function () {
    return gulp.src(lessDir + '/main.less')
        .pipe(less())
        .pipe(autoprefix('last 10 version'))
        .pipe(minifyCSS())
        .pipe(gulp.dest(targetCSSDir));
});

// Keep an eye on less, Coffee, and PHP files for changes...
gulp.task('watch', function () {
    gulp.watch(lessDir + '/**/*.less', ['css']);
});

// What tasks does running gulp trigger?
gulp.task('default', ['css', 'watch']);