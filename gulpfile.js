var
  gulp = require('gulp'),
  htmlmin = require('gulp-html-minifier'),
  watch = require('gulp-watch'),
  prefixer = require('gulp-autoprefixer'),
  uglify = require('gulp-uglify'),
  cssmin = require('gulp-minify-css'),
  browserSync = require("browser-sync"),
  clean = require('gulp-clean'),
  less = require('gulp-less'),
  path = require('path'),
  concat = require('gulp-concat'),
  uncss = require('gulp-uncss'),
  autoprefixer = require('gulp-autoprefixer');
  reload = browserSync.reload;

var config = {
  server: {
    baseDir: "./release",
    proxy: 'newz.ru'
  },
  tunnel: true,
  host: 'localhost',
  port: 9000,
  logPrefix: "Frontend_Devil"
};

var path = {
  build: { //Тут мы укажем куда складывать готовые после сборки файлы
    html: 'release/',
    php: 'release/',
    js: 'release/js/',
    css: 'release/css/',
    img: 'release/img/',
    fonts: 'release/fonts/'
  },
  src: { //Пути откуда брать исходники
    html: 'source/*.html', //Синтаксис src/*.html говорит gulp что мы хотим взять все файлы с расширением .html
    php: 'source/*.php', //Синтаксис src/*.html говорит gulp что мы хотим взять все файлы с расширением .html
    js: 'source/js/**/*.js',//В стилях и скриптах нам понадобятся только main файлы
    style: 'source/css/**/*.css',
    less: 'source/less/**/*.less',
    img: 'source/img/**/*.*', //Синтаксис img/**/*.* означает - взять все файлы всех расширений из папки и из вложенных каталогов
    fonts: 'source/fonts/**/*.*'
  },
  watch: { //Тут мы укажем, за изменением каких файлов мы хотим наблюдать
    html: 'source/*.html',
    php: 'source/*.php',
    js: 'source/js/**/*.js',
    less: 'source/less/**/*.less',
    style: 'source/css/**/*.css'
  },
  clean: './release'
};

gulp.task('style:build', function () {
  gulp.src(['./source/css/**/*.css'])
  .pipe(gulp.dest('release/css'));

  gulp.src(['./source/less/**/*.less'])
      .pipe(concat('main.css'))
      .pipe(less())
      .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
      .pipe(cssmin())
      .pipe(gulp.dest('release/css'))
      .pipe(reload({stream: true}));
});

gulp.task('html:build', function () {
    gulp.src([path.src.php, path.src.html])
        .pipe(htmlmin({collapseWhitespace: true}))
        .pipe(gulp.dest(path.build.html))
        .pipe(reload({stream: true}));
});

gulp.task('php:build', function() {
    gulp.src(['source/modules/**/*.php']).pipe(gulp.dest('release/modules'));
});

gulp.task('js:build', function () {
    gulp.src(path.src.js) //Найдем наш main файл
        .pipe(gulp.dest(path.build.js)) //Выплюнем готовый файл в build
        .pipe(reload({stream: true})); //И перезагрузим сервер
});

gulp.task('other:build', function() {
    gulp.src(path.src.fonts).pipe(gulp.dest(path.build.fonts));
    gulp.src(['source/favicon.ico']).pipe(gulp.dest('release/'));
    gulp.src(['source/images/**/*']).pipe(gulp.dest('release/images'));
});

gulp.task('fonts:build', function() {
    gulp.src(path.src.fonts)
        .pipe(gulp.dest(path.build.fonts))
});

gulp.task('build', [
    'html:build',
    'js:build',
    'style:build',
    'php:build',
    'other:build',
    'fonts:build'
]);

gulp.task('clean', function () {
    return gulp.src('release', {read: false})
        .pipe(clean());
});

gulp.task('watch', function(){
    watch([path.watch.html, path.watch.php], function(event, cb) {
      gulp.start('html:build');
    });

    watch(['source/modules/**/*.php'], function(event, cb) {
        gulp.start('php:build');
    });

    watch([path.watch.js], function(event, cb) {
        gulp.start('js:build');
    });

    watch([path.watch.less], function(event, cb) {
        gulp.start('style:build');
    });

    watch([path.watch.style], function(event, cb) {
        gulp.start('style:build');
    });
});

gulp.task('default', ['build', 'webserver', 'watch']);

gulp.task('webserver', function () {
  browserSync(config);
});
