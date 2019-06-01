var
  gulp = require('gulp'),
  watch = require('gulp-watch'),
  cssmin = require('gulp-minify-css'),
  //browserSync = require("browser-sync"),
  clean = require('gulp-clean'),
  less = require('gulp-less'),
  path = require('path'),
  concat = require('gulp-concat'),
  autoprefixer = require('gulp-autoprefixer');

var path = {
  root: 'release/',

  build: {
    php: 'release/',
    js: 'release/js/',
    css: 'release/css/',
    img: 'release/images',
    fonts: 'release/fonts/'
  },
  src: {
    php: 'source/**/*.php',
    js: 'source/js/**/*.js',
    css: 'source/css/**/*.css',
    less: 'source/less/**/*.less',
    img: 'source/images/**/*',
    fonts: 'source/fonts/**/*.*'
  },
  watch: {
    php: 'source/**/*.php',
    js: 'source/js/**/*.js',
    less: 'source/less/**/*.less',
    css: 'source/css/**/*.css'
  },
  clean: './release'
};

function styles() {
gulp.src(path.src.css)
  .pipe(gulp.dest(path.build.css));

  return gulp.src(path.src.less)
      .pipe(concat('main.css'))
      .pipe(less())
      .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
      .pipe(cssmin())
      .pipe(gulp.dest(path.build.css));
}

function php() {
	return gulp.src([path.src.php]).pipe(gulp.dest(path.build.php));
}

function js() {
	return gulp.src(path.src.js).pipe(gulp.dest(path.build.js));
}

function images() {
	return gulp.src(path.src.img).pipe(gulp.dest(path.build.img));
}

function perenos() {
    gulp.src(['source/favicon.ico']).pipe(gulp.dest(path.root));
	return gulp.src(path.src.fonts).pipe(gulp.dest(path.build.fonts));
}

function createDirs() {
  return gulp.src('*.*', {read: false})
      .pipe(gulp.dest('./release/images/news'))
      .pipe(gulp.dest('./release/images/sites/16'));
}

let build = gulp.series(createDirs, php, styles, js, images, perenos );

gulp.task('build', build);

gulp.task('default', gulp.series(build => {
  gulp.watch(path.watch.php, gulp.series(php));
  gulp.watch(path.watch.js, gulp.series(js));
  gulp.watch([path.watch.less, path.watch.css], gulp.series(styles));
}));
