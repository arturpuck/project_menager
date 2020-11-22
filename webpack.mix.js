const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */


mix.sass('resources/sass/auth/login_panel.scss', 'public/css')
    .sass('resources/sass/main_panel/projects.scss', 'public/css')
    .sass('resources/sass/team.scss', 'public/css')
    .sass('resources/sass/profitability.scss', 'public/css')
    .sass('resources/sass/income.scss', 'public/css')
    .js('resources/js/projects.ts', 'public/js')
    .js('resources/js/profitability.ts', 'public/js')
    .js('resources/js/team.ts', 'public/js')
    .js('resources/js/income.ts', 'public/js')
    .options({processCssUrls: false})
    .webpackConfig({
        resolve: {
            alias: {
                '@js' : path.resolve('resources/js'),
                '@jscomponents' : path.resolve('resources/js/components'),
                'sass' : path.resolve('resources/sass'),
                'sasscomponent' : path.resolve('resources/sass/components'),
            },
            extensions: ["*", ".js", ".jsx", ".vue", ".ts", ".tsx"]
        },

        module: {
            rules: [
              {
                test: /\.tsx?$/,
                loader: "ts-loader",
                options: { appendTsSuffixTo: [/\.vue$/] },
                exclude: /node_modules/
              }
            ]
          }
    })

