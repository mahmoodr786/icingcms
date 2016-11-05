var gulp = require('gulp'),  
    sass = require('gulp-sass')
    notify = require("gulp-notify")
    bower = require('gulp-bower');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var changed = require("gulp-changed");
var minifyCSS = require('gulp-minify-css');
var rename = require('gulp-rename');
var yuidoc = require("gulp-yuidoc");
var browserSync = require('browser-sync').create();

var config = {
    sassPath: './assets/sass',
    adminSassPath: './assets/Admin/sass',
    bowerDir: './bower_components'
}

function watchFolders(){
    gulp.watch('./src/Template' + "/**/*.ctp").on('change', browserSync.reload);
    gulp.watch('../ContentManager/src/Template' + "/**/*.ctp").on('change', browserSync.reload);
    gulp.watch('../IcingManager/src/Template' + "/**/*.ctp").on('change', browserSync.reload);
    gulp.watch('../UserManger/src/Template' + "/**/*.ctp").on('change', browserSync.reload);
}

gulp.task('bower', function() {
    return bower().pipe(gulp.dest(config.bowerDir));
});

gulp.task('icons', function() {
    return gulp.src(config.bowerDir + '/font-awesome/fonts/**.*')
    .pipe(gulp.dest('./webroot/fonts'));
});

gulp.task('css', function() {
    return gulp.src(config.sassPath + '/theme.scss')
   .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
   .pipe(gulp.dest('./webroot/css'))
.pipe(browserSync.stream());
});
//Admin CSS
gulp.task('cssAdmin', function() {
    return gulp.src(config.adminSassPath + '/theme.scss')
       .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
       .pipe(gulp.dest('./webroot/css/admin'))
       .pipe(browserSync.stream());
});

// Concatenate & Minify JS
gulp.task('jquery', function() {
    return gulp.src(
        [
            config.bowerDir + '/jquery/dist/jquery.min.js'
        ])
    .pipe(gulp.dest('./webroot/js'));
});
gulp.task('bootstrap', function() {
    return gulp.src(
        [
            config.bowerDir + '/bootstrap-sass/assets/javascripts/bootstrap.min.js'
        ])
    .pipe(gulp.dest('./webroot/js'));
});
 
gulp.task('scripts', function() {
    return gulp.src(
    	[
    		'./assets/js/*.js'
    	])
    .pipe(concat('theme.js'))
    .pipe(uglify())
    .pipe(gulp.dest('./webroot/js'))
    .pipe(browserSync.stream());
});
//Admin Scripts
gulp.task('scriptsAdmin', function() {
    return gulp.src(
        [
            './assets/js/*.js'
        ])
    .pipe(concat('theme.js'))
    .pipe(uglify())
    .pipe(gulp.dest('./webroot/js/admin'))
    .pipe(browserSync.stream());
});

gulp.task('watchadmin', function() {
    admin = true;
    gulp.watch('./assets/Admin/js/**/*.js', ['scriptsAdmin']);
    gulp.watch(config.adminSassPath + '/**/*.scss', ['cssAdmin']);
    watchFolders();
});
gulp.task('watch', function() {
    browserSync.init({
        proxy: "loc.icingcms.org"
    });
    gulp.watch('./assets/js/**/*.js', ['scripts']);
    gulp.watch(config.sassPath + '/**/*.scss', ['css']);
    watchFolders();
});

gulp.task('default', ['bower', 'icons', 'css', 'scripts','jquery','bootstrap']);
gulp.task('admin', ['bower', 'icons', 'cssAdmin', 'scriptsAdmin','jquery','bootstrap']);