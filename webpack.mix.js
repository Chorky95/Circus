const mix = require("laravel-mix");
const glob = require("glob");
const sass = require("sass-embedded");

// Theme directory
const theme = ".";
const blocksDir = `${theme}/blocks`;

mix.webpackConfig({
  stats: { children: true },
  externals: {
    "@wordpress/blocks": ["wp", "blocks"],
    "@wordpress/i18n": ["wp", "i18n"],
    "@wordpress/block-editor": ["wp", "blockEditor"],
    "@wordpress/components": ["wp", "components"],
    "@wordpress/element": ["wp", "element"],
  },
});

// CSS
mix
  .sass(`${theme}/styles/style.scss`, `${theme}/assets/css/style.css`, {
    implementation: sass,
  })
  .options({
    processCssUrls: false,
  });

// JS
let jsFiles = glob
  .sync(`${blocksDir}/acf/**/*.js`)
  .filter((file) => !file.endsWith(".min.js"));
jsFiles.unshift(`${theme}/scripts/scripts.js`);

mix.js(jsFiles, `${theme}/assets/js/scripts.min.js`);

// Build React blocks separately
const reactBlocks = glob.sync(`${blocksDir}/react/*/index.js`);
reactBlocks.forEach((file) => {
  // Normalize path separators and extract block name
  const normalizedPath = file.replace(/\\/g, "/");
  const pathParts = normalizedPath.split("/");
  const blockName = pathParts[pathParts.length - 2]; // Get parent directory name
  const outputPath = `${blocksDir}/react/${blockName}/build/index.js`;
  mix.js(file, outputPath).react();
});

// Block styles
// glob.sync(`${blocksDir}/**/*.scss`).forEach(file => {
//     let output = file.replace('.scss', '.css');
//     mix.sass(file, output, { implementation: sass });
// });
