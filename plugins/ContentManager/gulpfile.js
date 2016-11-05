var gulp = require('gulp'); 
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var changed = require("gulp-changed");


gulp.task('scripts', function() {
    return gulp.src(
    	[
            './assets/js/*.js'
    	]
    )
    .pipe(concat('contentmanager.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('./webroot/js'));
});

gulp.task('copyjs', function() {
    return gulp.src(
      [
        './node_modules/remodal/dist/remodal.min.js',
        './node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js'
      ]
    )
    .pipe(gulp.dest('./webroot/js'));
});

gulp.task('copycss', function() {
    return gulp.src([
      './node_modules/remodal/dist/remodal.css',
      './node_modules/remodal/dist/remodal-default-theme.css',
      './node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css'
    ])
    .pipe(gulp.dest('./webroot/css/'));
});

gulp.task('watch', function() {
    gulp.watch('./assets/js/**/*.js', ['scripts']);
});

gulp.task('default', ['scripts', 'copyjs', 'copycss']);