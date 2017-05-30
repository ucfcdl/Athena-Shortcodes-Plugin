var gulp   = require('gulp'),
    autoprefixer = require('gulp-autoprefixer'),
    cleanCSS = require('gulp-clean-css'),
    rename = require('gulp-rename'),
    sass = require('gulp-sass'),
    scsslint = require('gulp-scss-lint'),
    readme = require('gulp-readme-to-markdown');

var config = {
  src: {
    scssPath: './src/scss'
  },
  dist: {
    cssPath: './static/css',
    fontPath: './static/fonts'
  },
  packagesPath: './node_modules'
};


//
// Installation of components/dependencies
//

// Copy Athena fonts
gulp.task('move-components-athena-fonts', function() {
  gulp.src(config.packagesPath + '/ucf-athena-framework/dist/fonts/**/*')
   .pipe(gulp.dest(config.dist.fontPath));
});

// Run all component-related tasks
gulp.task('components', [
  'move-components-athena-fonts'
]);


//
// CSS
//

// Lint scss files
gulp.task('scss-lint', function() {
  return gulp.src(config.src.scssPath + '/*.scss')
    .pipe(scsslint({
      'maxBuffer': 400 * 1024  // default: 300 * 1024
    }));
});

// Compile scss files
function buildCSS(src, filename, dest) {
  dest = dest || config.dist.cssPath;

  return gulp.src(src)
    .pipe(sass({
      includePaths: [config.src.scssPath, config.packagesPath]
    })
      .on('error', sass.logError))
    .pipe(cleanCSS())
    .pipe(autoprefixer({
      // Supported browsers added in package.json ("browserslist")
      cascade: false
    }))
    .pipe(rename(filename))
    .pipe(gulp.dest(dest));
}

gulp.task('scss-build-editor-css', function() {
  return buildCSS(config.src.scssPath + '/athena-editor-styles.scss', 'athena-editor-styles.min.css');
});

gulp.task('scss-build', ['scss-build-editor-css']);

// All css-related tasks
gulp.task('css', ['scss-lint', 'scss-build']);


//
// Readme
//

gulp.task('readme', function() {
  gulp.src('./readme.txt')
    .pipe(readme({
      details: false,
      screenshot_ext: []
    }))
    .pipe(gulp.dest('.'));
});

gulp.task('default', ['components', 'css', 'readme']);
