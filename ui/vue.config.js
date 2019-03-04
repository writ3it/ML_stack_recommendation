
var p = './../docs/ui';
const path = require("path");

module.exports = {
    outputDir: path.resolve(__dirname, p),
    chainWebpack: config => {
        config.resolve.alias
            .set("@api", path.resolve(__dirname, p));
    },

    pluginOptions: {
        quasar: {
            theme: 'mat'
        }
    },
    publicPath: process.env.NODE_ENV === 'production'
        ? './'
        : '/'
}
