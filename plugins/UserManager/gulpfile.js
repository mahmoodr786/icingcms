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
    .pipe(concat('usermanager.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('./webroot/js'));
});

gulp.task('watch', function() {
    gulp.watch('./assets/js/**/*.js', ['scripts']);
});

gulp.task('default', ['scripts']);