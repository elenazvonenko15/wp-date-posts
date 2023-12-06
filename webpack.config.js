const path = require('path');

module.exports = {
    entry: {
        'main': [
            './assets/js/main.js',
            './assets/scss/main.scss'
        ]
    },
    output: {
        filename: 'main.bundle.js',
        path: path.resolve(__dirname, 'assets/dist'),
    },
    module: {
        rules: [
            {
                test: /\.scss$/,
                use: ['style-loader', 'css-loader', 'sass-loader'],
            },
        ],
    },
};
