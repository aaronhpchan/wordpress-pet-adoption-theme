const { src, dest, watch, series } = require('gulp');
const sass = require('gulp-sass')(require('sass'));

const sassSources = [
  './*.scss', // Picks up style.scss file at the root of the theme
  'css/**/*.scss', // All other Sass files in the /css directory
];

function buildStyles() {
  return src(sassSources)
    .pipe(sass())
    .pipe(dest('.')); // Output compiled files in the same directory as Sass sources
}

function watchTask() {
  watch(sassSources, buildStyles);
}

exports.default = series(buildStyles, watchTask);