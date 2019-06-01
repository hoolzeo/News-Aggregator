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

var config = {
  server: {
    baseDir: "./release",
    proxy: 'newz.ru'
  },
  tunnel: false,
  host: 'localhost',
  port: 9000,
  logPrefix: "Frontend_Devil"
};

var path = {
  build: { //Тут мы укажем куда складывать готовые после сборки файлы
    php: 'release/',
    js: 'release/js/',
    css: 'release/css/',
    img: 'release/img/',
    fonts: 'release/fonts/'
  },
  src: { //Пути откуда брать исходники
    php: 'source/**/*.php',
    js: 'source/js/**/*.js',//В стилях и скриптах нам понадобятся только main файлы
    style: 'source/css/**/*.css',
    less: 'source/less/**/*.less',
    img: 'source/img/**/*.*', //Синтаксис img/**/*.* означает - взять все файлы всех расширений из папки и из вложенных каталогов
    fonts: 'source/fonts/**/*.*'
  },
  watch: { //Тут мы укажем, за изменением каких файлов мы хотим наблюдать
    php: 'source/**/*.php',
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
      .pipe(gulp.dest('release/css'));
});

gulp.task('php:build', function () {
    gulp.src([path.src.php])
        .pipe(gulp.dest(path.build.php));
});

gulp.task('js:build', function () {
    gulp.src(path.src.js) //Найдем наш main файл
        .pipe(gulp.dest(path.build.js)); //И перезагрузим сервер
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
    watch([path.watch.php], function(event, cb) {
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

gulp.task('default', ['build', 'watch']);

gulp.task('webserver', function () {
  browserSync(config);
});
