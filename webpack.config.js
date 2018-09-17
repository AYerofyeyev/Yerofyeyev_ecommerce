const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
// const HtmlWebpackPlugin = require('html-webpack-plugin');
module.exports = {
    entry: { main: './src_fe/js/index.js' },
    output: {
        path: path.resolve(__dirname, './src/AppBundle/Resources/public'),
        filename: 'js/script.js'
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: "babel-loader"
                }
            },
            {
                test: /\.s?css$/,
                use: ['style-loader', MiniCssExtractPlugin.loader, 'css-loader', 'postcss-loader', 'sass-loader']
            },
            {
                test: /\.(png|jpe?g|gif|svg)$/i,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                            name: '[name].[ext]',
                            outputPath: '../img/'
                        }
                    },
                    {
                        loader: 'image-webpack-loader',
                        options: {
                            mozjpeg: {
                                progressive: true,
                                quality: 65
                            },
                            // optipng.enabled: false will disable optipng
                            optipng: {
                                enabled: false,
                                },
                            pngquant: {
                                quality: '65-90',
                                speed: 4
                            },
                            gifsicle: {
                                interlaced: false,
                            },
                            // the webp option will enable WEBP
                            webp: {
                                quality: 75
                            }
                        }
                    }
                ]
            },
            {
                test: /\.(woff|otf)$/i,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                            name: '[name].[ext]',
                            outputPath: '../fonts/'
                        }
                    }
                ]
            },
            {
                test: /\.pdf$/,
                // include: /files/,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                            name: '[name].[ext]',
                            outputPath: '../files/'
                        }
                    }
                ]
            }
        ]
    },
    plugins: [
        new MiniCssExtractPlugin(
            {filename: 'css/style.css'}
        )
        // ,
        // new HtmlWebpackPlugin({
        //     inject: false,
        //     hash: true,
        //     filename: 'index.html',
        //     template: './src_fe/index.html',
        //     chunks: ['main'],
        //     minify: {
        //         removeComments: true,
        //         collapseWhitespace: true,
        //         conservativeCollapse: true,
        //         preserveLineBreaks: true,
        //         removeRedundantAttributes: true,
        //         removeScriptTypeAttributes: true,
        //         removeStyleLinkTypeAttributes: true
        //     }
        // })
        // ,new HtmlWebpackPlugin({
        //     inject: false,
        //     hash: true,
        //     filename: 'about.html',
        //     template: './src/about.html',
        //     chunks: ['aboutEntry'],
        //     minify: {
        //         removeComments: true,
        //         collapseWhitespace: true,
        //         conservativeCollapse: true,
        //         preserveLineBreaks: true,
        //         removeRedundantAttributes: true,
        //         removeScriptTypeAttributes: true,
        //         removeStyleLinkTypeAttributes: true
        //     }
        // }),
        // new HtmlWebpackPlugin({
        //     inject: false,
        //     hash: true,
        //     filename: 'work.html',
        //     template: './src/work.html',
        //     chunks: ['workEntry'],
        //     minify: {
        //         removeComments: true,
        //         collapseWhitespace: true,
        //         conservativeCollapse: true,
        //         preserveLineBreaks: true,
        //         removeRedundantAttributes: true,
        //         removeScriptTypeAttributes: true,
        //         removeStyleLinkTypeAttributes: true
        //     }
        // }),
        // new HtmlWebpackPlugin({
        //     inject: false,
        //     hash: true,
        //     filename: 'contact.html',
        //     template: './src/contact.html',
        //     chunks: ['contactEntry'],
        //     minify: {
        //         removeComments: true,
        //         collapseWhitespace: true,
        //         conservativeCollapse: true,
        //         preserveLineBreaks: true,
        //         removeRedundantAttributes: true,
        //         removeScriptTypeAttributes: true,
        //         removeStyleLinkTypeAttributes: true
        //     }
        // })
    ],

    watch: true,
    watchOptions: {
        aggregateTimeout: 300,
        poll: 1000,
        ignored: /node_modules/
    }
};
