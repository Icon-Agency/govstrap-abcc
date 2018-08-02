var webpack  = require('webpack'),
    path     = require('path'),
    uglify   = require('uglifyjs-webpack-plugin'),
    srcPath  = path.join(__dirname, '/src/js'),
    distPath = path.join(__dirname, '/build/js');

module.exports = {
    cache: false,
    watch: true,
    bail: false,
    context: srcPath,
    // what is the entry point to our app
    entry: {
        app: [
            './app.js'
        ],
        vendors: [
            'jquery',
            'tether',
            'popper.js',
            'bootstrap'
        ]
    },
    output: {
        path: distPath,
        filename: '[name].js',
        chunkFilename: '[name].chunk.[id].[hash].js',
        publicPath: '/build/js/'
    },
    resolve: {
        modules: [
            path.resolve('./'),
            path.resolve('./node_modules'),
        ],
    },
    module: {
        loaders: [{
            test: /\.js$/,
            exclude: /node_modules/,
            loader: 'babel-loader'
        }]
    },
    stats: {
        colors: true
    },
    // ref all external scripts here that are not been refed in node_modules
    // externals: {
    //     "jquery": "jQuery"
    // },
    plugins: [

        // Ref all additional node_modules and external scripts here
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery',
            Tether: 'tether',
            Popper: 'popper.js'
        }),

        new webpack.optimize.CommonsChunkPlugin({ name: 'vendors', filename: 'vendors.js' }),
        new webpack.optimize.CommonsChunkPlugin({ name: 'common', filename: 'webpack.common.js' }),

        new uglify({
            uglifyOptions: {
                ie8: false
            }
        })
    ],
    target: 'web',
};
