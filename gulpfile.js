var gulp = require('gulp'),
    sass = require('gulp-ruby-sass'),
    autoprefix = require('gulp-autoprefixer'),
    notify = require('gulp-notify'),
    concat = require('gulp-concat'),
    bower = require('gulp-bower');

var config = {
    sassPath: './resources/sass',
    jsPath: './resources/js',
    bowerDir: './bower_components'
};

gulp.task('bower', function() {
    return bower()
        .pipe(gulp.dest(config.bowerDir));
});

gulp.task('icons', function() {
    return gulp.src(config.bowerDir + '/fontawesome/fonts/**/*')
        .pipe(gulp.dest('./public/fonts'));
});

gulp.task('css', function() {
    return gulp.src(config.sassPath + '/app.scss')
        .pipe(sass({
            style: 'compressed',
            loadPath: [
                './resources/sass',
                config.bowerDir + '/bootstrap-sass-official/assets/stylesheets',
                config.bowerDir + '/fontawesome/scss'
            ]
        }))
        .on('error', notify.onError(function(error) {
            return "Error:" + error.message;
        }))
        .pipe(autoprefix('last 2 version'))
        .pipe(gulp.dest('./public/css/'));
});

gulp.task('watch', function() {
    gulp.watch(config.sassPath + "/**/*.scss", ['css']);
    gulp.watch(config.jsPath + '/**/*.js', ['js']);
});

gulp.task('js', function() {
    return gulp.src([
            config.bowerDir + '/jquery/dist/jquery.js',
            config.bowerDir + '/bootstrap-sass-official/assets/javascripts/bootstrap.js',
            config.bowerDir + '/angular/angular.js',
            config.bowerDir + '/angular-resource/angular-resource.js',
            './resources/js/app.js'
        ])
        .pipe(concat('all.js'))
        .pipe(gulp.dest('./public/js/'));
});

gulp.task('default', ['bower', 'icons', 'css']);