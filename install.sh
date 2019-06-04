#!/bin/bash

# Установка Curl
#apt-get install curl
# curl -sL https://deb.nodesource.com/setup_10.x | sudo bash -

# Установка Node Js (npm)
# apt install nodejs

# Если не работает установщик:
# aptitude install dos2unix
# dos2unix script.sh

# Установка Gulp и пакетов в проект
npm install gulp
npm install gulp-watch --save-dev
npm install gulp-minify-css --save-dev
npm install gulp-clean --save-dev
npm install gulp-less --save-dev
npm install path --save-dev
npm install gulp-concat --save-dev
npm install gulp-autoprefixer --save-dev