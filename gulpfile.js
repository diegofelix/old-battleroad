// plugins
var gulp        = require('gulp');
var gutil       = require('gulp-util');
var less        = require('gulp-less');
var autoprefix  = require('gulp-autoprefixer');
var minifyCSS   = require('gulp-minify-css');
var uglify      = require('gulp-uglify');
var concat      = require('gulp-concat');

// from
var lessDir     = 'app/assets/less';
var jsLibDir    = 'app/assets/js/lib';
var jsDir       = 'app/assets/js';

// compile to
var targetCSSDir = 'public/css';
var targetJsDir  = 'public/js';


// Compile less, autoprefix CSS3,
// and save to target CSS directory
gulp.task('css', function () {
    return gulp.src(lessDir + '/main.less')
        .pipe(less())
        .pipe(autoprefix('last 10 version'))
        .pipe(minifyCSS())
        .pipe(gulp.dest(targetCSSDir));
});

gulp.task('libJS', function(){
    gulp.src([
        jsLibDir + '/jquery.js',
        jsLibDir + '/bootstrap.js',
        jsLibDir + '/wow.js',
    ])
    .pipe(concat('min.js'))
    .pipe(uglify({preserveComments: "some"}))
    .pipe(gulp.dest(targetJsDir));
});

gulp.task('js', function() {
  gulp.src([
        jsDir + '/*.js' ])
    .pipe(uglify({preserveComments: "some"}))
    .pipe(gulp.dest(targetJsDir));
});

gulp.task('watch', function () {
    gulp.watch(lessDir + '/**/*.less', ['css']);
    gulp.watch(jsDir + '/**/*.js', ['js']);
});

// What tasks does running gulp trigger?
gulp.task('default', ['css', 'libJS', 'js', 'watch']);