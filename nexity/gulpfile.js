var gulp = require('gulp'),
    jade = require('gulp-jade'),
    htmlmin = require('gulp-htmlmin'),
    sass = require('gulp-sass'),
    rename = require('gulp-rename'),
    cleanCSS = require('gulp-minify-css'),
    autoprefixer = require('gulp-autoprefixer'),
    coffee = require('gulp-coffee'),
    gutil = require('gulp-util'),
    uglify = require('gulp-uglify');

function swallowError (error) {
    
    console.log(error.toString());
    this.emit('end');
}

gulp.task('jade', function() {
	
	return gulp.src('src/jade/*.jade')
               .pipe(jade())
               .on('error', swallowError)
               .pipe(htmlmin({collapseWhitespace: true}))
               .pipe(gulp.dest('dist/'));
});

gulp.task('sass', function() {
	
	return gulp.src('src/sass/main.scss')
               .pipe(sass())
               .on('error', swallowError)
               .pipe(autoprefixer())
               .pipe(cleanCSS({keepSpecialComments: 0}))
    		   .pipe(rename('style.css'))
               .pipe(gulp.dest('dist/'));
});

gulp.task('coffee', function() {
    
    return gulp.src('src/coffee/*.coffee')
               .pipe(coffee({bare: true}))
               .on('error', swallowError)
               .pipe(uglify())
               .pipe(rename('script.js'))
               .pipe(gulp.dest('dist/'));
});

gulp.task('watch', function () {
  
    gulp.watch('src/sass/**/*.scss', ['sass']);
	gulp.watch('src/jade/*.jade', ['jade']);
    gulp.watch('src/coffee/*.coffee', ['coffee']);
});

gulp.task('default', ['jade', 'sass']);
