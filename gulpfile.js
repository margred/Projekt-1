var gulp = require('gulp');
var sass = require('gulp-sass');
var connect = require('gulp-connect-php');
var browserSync = require('browser-sync').create();

gulp.task('sass', function () {
    gulp.src('scss/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./public/css/'))
});

gulp.task('serve', ['sass'], function () {
    var port = 8000;
    var config = {
        base: 'public',
        port: port,
        keepalive: true
    };
    connect.server(config, function (){
        browserSync.init({
            proxy: '127.0.0.1:' + port
        });
    });
});

gulp.task('default', ['serve'], function () {
    gulp.watch('scss/**/*.scss', ['sass', browserSync.reload]);
});
