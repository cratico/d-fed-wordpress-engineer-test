const glob = require('glob');
const path = require('path');

// Plugins
const ConcatPlugin = require('webpack-file-concat-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

// is Dev mode
const devMode = process.env.NODE_ENV !== 'production';

// helpers
const getResolveFunc = function(dirnamePath) {
    return function resolve(p) {
      return path.resolve(dirnamePath, p);
    };
};
const resolveFunc = getResolveFunc(__dirname);

module.exports = {
  mode: devMode ? 'development' : 'production',
  optimization: {
    minimize: !devMode,
  },
  // defines the entry files
  entry: glob.sync('{./src/styles.js,./src/scripts/**/*.js}'),
  output: {
    // defines the output path
    path: path.resolve(__dirname, 'out'),
    clean: true,
  },
  module: {
    rules: [
      // rule to transpile JavaScript
      {
        test: /\.js$/,
        exclude: /(node_modules|bower_components)/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env'],
          },
        },
      },
      // rule to handle the scss files
      {
        test: /\.scss$/,
        use: [
          MiniCssExtractPlugin.loader,
          //'style-loader',
          'css-loader',
          {
            loader: 'sass-loader',
            options: {
              sassOptions: {
                includePaths: ['src/styles'].map(resolveFunc),
              },
            },
          },
        ],
      },
    ],
  },
  plugins: [
    // extracts the styles on css files
    new MiniCssExtractPlugin({
      filename: '[name].css',
      chunkFilename: '[id].css',
    }),
    // concats the all over the js files and creates the JS bundle
    new ConcatPlugin({
      source: '**/*.css',
      deleteSourceFiles: true,
      destination: 'style.css',
    }),
    // concats the all over the css files and creates the CSS bundle
    new ConcatPlugin({
      source: '**/*.js',
      deleteSourceFiles: true,
      destination: 'script.js',
    }),
  ],
};
