var gulp = require("gulp");
var sass = require("gulp-sass");
var postcss = require("gulp-postcss");
var autoprefixer = require("autoprefixer");
var cssnano = require("cssnano");
var sourcemaps = require("gulp-sourcemaps");
//var babel = require('gulp-babel');
var concat = require('gulp-concat');
let uglify = require('gulp-uglify-es').default;
var gutil = require('gulp-util');
var browserSync = require("browser-sync").create();

var paths = {
    local: "localhost/iconbrand",
    styles: {
        pluginCSS: "assets/css/**/*.css",
        sassCss: "assets/scss/**/*.scss",
        distCSS: "dist/css"
    },
    js: {
        assetsVendor: "assets/js/vendor/**/*.js",
        assetsMain: "assets/js/main.js",
        assetsJS: "assets/js/**/*.js",
        distJs: "dist/js"
    }
};
// Style Sass do Css
function sassToCss() {
    return (
        gulp
        .src(paths.styles.sassCss)
        .pipe(sourcemaps.init())
        .pipe(sass())
        .on("error", sass.logError)
        .pipe(postcss([autoprefixer(  )]))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(paths.styles.distCSS))
        .pipe(browserSync.stream())
        .on( 'end', function(){ gutil.log( gutil.colors.green( 'Główne style Sass zostały zmienione na Css.' ) ); } )
    );
}
// CSS plugin
function cssPlugin() {
    return (
        gulp
        .src(paths.styles.pluginCSS)
        .on("error", sass.logError)
        .pipe(postcss([cssnano({
            discardComments: {
                removeAll: true
            }
        })]))
        .pipe(concat('plugin.min.css'))
        .pipe(gulp.dest(paths.styles.distCSS))
        .on( 'end', function(){ gutil.log( gutil.colors.green( 'Css\'y pluginów zostały połączone i zminifikowane.' ) ); } )
    );
}
// Js
function jsDev(done) {
    gulp
        .src( [ paths.js.assetsVendor, paths.js.assetsMain] )
        .pipe(concat('scripts.js'))
        .pipe(gulp.dest(paths.js.distJs))
        .on( 'end', function(){ gutil.log( gutil.colors.green( 'JavaScript\'y zostały połączone i zminifikowane.' ) ); } )
    done();
}

function server(done) {
    browserSync.init({
        proxy: paths.local
    });
    done();
}

function liveReload(done) {
    browserSync.reload();
    done();
}



// PRODUKCJA
// Minifikacja CSS
function cssMin() {
    return (
        gulp
        .src( paths.styles.distCSS+'/main.css')
        .on("error", sass.logError)
        .pipe(postcss([autoprefixer(), cssnano({
            discardComments: {
                removeAll: true
            }
        })]))
        .pipe(concat('main.min.css'))
        .pipe(gulp.dest(paths.styles.distCSS))
        .on( 'end', function(){ gutil.log( gutil.colors.green( 'Główne style zostały zminifikowane.' ) ); } )
    );
}

// Js
function jsMin(done) {
    gulp
        .src( paths.js.distJs+'/scripts.js' )
        .pipe(concat('scripts.min.js'))
        .pipe( uglify() )
        .pipe(gulp.dest(paths.js.distJs))
        .on( 'end', function(){ gutil.log( gutil.colors.green( 'JavaScript\'y zostały zminifikowane.' ) ); } )
    done();
}


function dev() {
    gulp.watch(paths.styles.sassCss, sassToCss);
    gulp.watch(paths.styles.pluginCSS, cssPlugin);
    gulp.watch(["**/*.html", "./**/*.php"], liveReload);
    gulp.watch( [paths.js.assetsVendor, paths.js.assetsMain], gulp.series(jsDev, liveReload));
}

exports.dev = gulp.series(server, dev);
exports.build = gulp.series(cssMin, jsMin);
