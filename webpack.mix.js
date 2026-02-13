const mix = require("laravel-mix");
const glob = require("glob");
const sass = require("sass-embedded");

// Theme directory
const theme = ".";
const blocksDir = `${theme}/blocks`;

mix.webpackConfig({
	stats: { children: true },
});

// CSS
mix.sass(`${theme}/styles/style.scss`, `${theme}/assets/css/style.css`, { implementation: sass }).options({
	processCssUrls: false,
});

// JS
let jsFiles = glob.sync(`${blocksDir}/**/*.js`).filter((file) => !file.endsWith(".min.js"));
jsFiles.unshift(`${theme}/scripts/scripts.js`);

mix.js(jsFiles, `${theme}/assets/js/scripts.min.js`);

// Block styles
// glob.sync(`${blocksDir}/**/*.scss`).forEach(file => {
//     let output = file.replace('.scss', '.css');
//     mix.sass(file, output, { implementation: sass });
// });
