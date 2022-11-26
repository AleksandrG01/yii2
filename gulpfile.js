"use strict";

let theme_folder = "Demo"; // Изменить название  (Так будет называться тема) и необходимо копировато папку custom в \themes\custom или название вашей темы
let source_folder = "themes/" + theme_folder + "/assets/src";
let projekt_folder = "themes/" + theme_folder + "/assets/src/#dist";
let build_theme_folder = "themes/" + theme_folder + "/assets";

//site in (development/support)
let ds = "development";


let fs = require('fs');
let path = {
	build: {
		html: projekt_folder + "/",
		htmlOc: projekt_folder + "/",
		htmlComponents: projekt_folder + "/html-components/",
		css: projekt_folder + "/css/",
		cssOc: build_theme_folder + "/css/",
		js: projekt_folder + "/javascript/",
		jsOc: build_theme_folder + "/javascript/",
		img: projekt_folder + "/images/",
		imgOc: build_theme_folder + "/images/",
		svg: projekt_folder + "/images/svg-sprite/",
		svgOc: build_theme_folder + "/images/svg-sprite/",
		fonts: projekt_folder + "/fonts/",
		fontsOc: build_theme_folder + "/fonts/",
	},
	src: {
		html: source_folder + ["/html/**/*.html"],
		htmlComponents: [source_folder + "/html/html-components/_*.html"],
		css: source_folder + "/css/main.scss",
		js: source_folder + "/js/scripts/script.js",
		vendor: source_folder + "/vendor/build/**/*.js",
		img: source_folder + "/images/**/*.{jpg,png,svg,gif,ico,webp}",
		fonts: source_folder + "/fonts/*.ttf"
	},
	watch: {
		html: source_folder + "/html/**/*.html",
		css: source_folder + "/css/**/*.scss",
		js: source_folder + "/js/scripts/**/*.js",
		img: source_folder + "/images/**/*.{jpg,png,svg,gif,ico,webp}",
	},
	clean: projekt_folder + "/",
}

let {
	src,
	dest
} = require('gulp'),
	gulp = require('gulp'),
	browsersync = require('browser-sync').create(),
	fileinclude = require('gulp-file-include'),
	del = require('del'),
	sass = require('gulp-sass')(require('sass')),
	autoprefixer = require('gulp-autoprefixer'),
	group_media = require('gulp-group-css-media-queries'),
	cleanCSS = require('gulp-clean-css'),
	rename = require("gulp-rename"),
	uglify = require('gulp-uglify-es').default,
	// webpack = require('webpack-stream'),
	imagemin = require('gulp-imagemin'),
	//webp = require('gulp-webp'),
	//webpHTML = require('gulp-webp-html'),
	//webpcss = require("gulp-webpcss"),
	svgSprite = require('gulp-svg-sprite'),
	ttf2woff2 = require('gulp-ttf2woff2'),
	ttf2woff = require('gulp-ttf2woff'),
	fonter = require('gulp-fonter'),
	concat = require('concat'),
	notify = require('gulp-notify'),
	newer = require('gulp-newer'),
	sassGlob = require('gulp-sass-glob'),
	wait = require('gulp-wait'),
	changed = require('gulp-changed');


function browserSync(params) {
	browsersync.init({
		server: {
			baseDir: "./" + projekt_folder + "/"
		},
		port: 3000,
		notify: false
	})
}

function browserSyncReload() {
	return browsersync.stream()
}

//Функция для работы с HTML файлами
function html() {
	return src(path.src.html)
		.pipe(fileinclude())
		.pipe(dest(path.build.html))
		.pipe(browsersync.stream())
}

//Функция для работы с HTML компонентами
function htmlComponents() {
	return src(path.src.htmlComponents)
		.pipe(fileinclude())
		.pipe(dest(path.build.htmlComponents))
		.pipe(browsersync.stream())
}

//Функция для работы с CSS файлами
function css(params) {
	return src(path.src.css)
		.pipe(fileinclude())
		.pipe(sassGlob())
		.pipe(wait(100))
		.pipe(
			sass({
				includePaths: [source_folder + '/css/main.scss'],
				outputStyle: "expanded"
			}))
		.on("error", notify.onError({
			message: "Error: <%= error.message %>",
			title: "Error SCSS"
		}))
		.pipe(
			group_media()
		)
		.pipe(
			autoprefixer({
				overrideBrowserslist: ["last 5 versions"],
				cascade: true
			})
		)
		//.pipe(webpcss({webpClass: '.webp',noWebpClass: '.no-webp'}))
		.pipe(dest(path.build.css))
		.pipe(dest(path.build.cssOc))
		.pipe(cleanCSS())
		.pipe(
			rename({
				extname: ".min.css"
			})
		)
		.pipe(dest(path.build.css))
		.pipe(dest(path.build.cssOc))
		.pipe(browsersync.stream())
}

//Функция для работы с JavaScript файлами
function js() {
	return src(path.src.js)
		.pipe(fileinclude())
		.pipe(dest(path.build.js))
		.pipe(dest(path.build.jsOc))
		.pipe(uglify())
		.on("error", notify.onError({
			message: "Error: <%= error.message %>",
			title: "Error JavaScript"
		}))
		.pipe(
			rename({
				extname: ".min.js"
			})
		)
		.pipe(dest(path.build.js))
		.pipe(dest(path.build.jsOc))
		.pipe(browsersync.stream())
}

//copy vendor folder
function copy() {
	return src(path.src.vendor)
		.pipe(dest(path.build.js))
		.pipe(dest(path.build.jsOc))
}

//Функция для работы с картинками
function images() {
	return src(path.src.img)
		.pipe(changed(path.build.img))
		.pipe(imagemin({
			interlaced: true,
			progressive: true,
			optimizationLevel: 6, //Select an optimization level between 0 and 7
			svgoPlugins: [{
				removeViewBox: false
			}]
		}))
		.pipe(dest(path.build.img))
		.pipe(dest(path.build.imgOc))
		//.pipe(src(path.src.img))
		//.pipe(webp({ quality: 70 }))
		//.pipe(changed(path.build.img))
		//.pipe(dest(path.build.img))
		//.pipe(dest(path.build.imgOc))
		.pipe(browsersync.stream())
}

//Функция для работы отслеживания изменений в файлах
function watchFiles(params) {
	gulp.watch([path.watch.html], html)
	gulp.watch([path.watch.css], css)
	gulp.watch([path.watch.js], js)
	gulp.watch([path.watch.img], images)
}

//Функция для конвертирования шрифта из OTF в TTF запуск командой gulp otf2ttf
gulp.task('otf2ttf', function () {
	return gulp.src([source_folder + '/fonts/*.otf'])
		.pipe(fonter({
			formats: ['ttf']
		}))
		.pipe(dest(source_folder + '/fonts/'))
})

//Функция для работы с шрифтами
function fonts(params) {
	src(path.src.fonts)
		.pipe(ttf2woff())
		.pipe(dest(path.build.fonts))
		.pipe(dest(path.build.fontsOc))
	return src(path.src.fonts)
		.pipe(ttf2woff2())
		.pipe(dest(path.build.fonts))
		.pipe(dest(path.build.fontsOc));
}

//Функция для очистки папки 
function clean(params) {
	return del(path.clean)
}

//Функция для очистки папки 
function cleanOc(params) {
	//return del(path.cleanOc, {force: true})
}

//Функция для сборки всех SVG иконок в спрайт запуск по каманде gulp svgsprite
function svgsprite(done) {
	gulp.src(source_folder + '/i/svg/*.svg')
		.pipe(svgSprite({
			mode: {
				symbol: true // Activate the «symbol» mode
			},
		}))
		.pipe(dest(path.build.svg))
		.pipe(dest(path.build.svgOc));
	done();
}



function cb() {}

//if the site is only in development
if (ds === "development") {

	let build = gulp.series(clean, copy, gulp.parallel(js, css, html, htmlComponents, images, fonts, svgsprite));
	exports.fonts = fonts;
	exports.images = images;
	exports.js = js;
	exports.copy = copy;
	exports.css = css;
	exports.svgsprite = svgsprite;
	exports.html = html;
	exports.html = htmlComponents;

	let watch = gulp.parallel(build, watchFiles, browserSync);
	exports.build = build;
	exports.watch = watch;
	exports.default = watch;

} else if (ds === "support") {

	//site support
	let build = gulp.series(clean, gulp.parallel(js, css, svgsprite));
	exports.js = js;
	exports.css = css;
	exports.svgsprite = svgsprite;

	let watch = gulp.parallel(build, watchFiles, browserSync);
	exports.build = build;
	exports.watch = watch;
	exports.default = watch;
}