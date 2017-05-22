var gulp   = require('gulp'),
    readme = require('gulp-readme-to-markdown');

var config = {
  dist: {
    athenaPath: './static/athena-framework/'
  },
  packagesPath: './node_modules'
};


//
// Installation of components/dependencies
//

// Copy Athena css
gulp.task('move-components-athena-fonts', function() {
  gulp.src(config.packagesPath + '/athena-framework/dist/fonts/**/*')
   .pipe(gulp.dest(config.dist.athenaPath + '/fonts'));
});

// Copy Athena fonts
gulp.task('move-components-athena-css', function() {
  gulp.src(config.packagesPath + '/athena-framework/dist/css/**/*')
   .pipe(gulp.dest(config.dist.athenaPath + '/css'));
});

// Run all component-related tasks
gulp.task('components', [
  'move-components-athena-fonts',
  'move-components-athena-css'
]);


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

gulp.task('default', ['components', 'readme']);
