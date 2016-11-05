var gulp = require('gulp'); 
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var changed = require("gulp-changed");


gulp.task('fileapi', function() {

    return gulp.src(['./node_modules/fileapi/dist/**/*'])
    .pipe(gulp.dest('./webroot/js/FileAPI/dist/'));

});

gulp.task('scripts', function() {
    return gulp.src(
    	[
            './assets/js/*.js'
    	]
    )
    .pipe(concat('filemanager.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('./webroot/js'));
});

gulp.task('watch', function() {
    gulp.watch('./assets/js/**/*.js', ['scripts']);
});

gulp.task('default', ['scripts','fileapi']);