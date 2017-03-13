var path = require('path');
var webpack = require('webpack');

module.exports = {
  entry: './apps/client/src/main.js',
  output: {
    path: __dirname + '/public/js',
    filename: 'bundle.js'
  },
  module: {
    loaders: [
      {
        test: /\.js$/,
        loader: 'babel-loader',
        exclude: /node_modules/
      },
      {
        test: /\.vue$/,
        loader: 'vue-loader'
      }
    ]
  },
  resolve: {
      alias: {
        'vue$': 'vue/dist/vue.esm.js'
      }
    },
}
