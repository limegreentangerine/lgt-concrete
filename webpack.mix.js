let mix = require('laravel-mix')
const path = require('path');
const svelteComponents = require('./svelte-components.json');

/*
    |--------------------------------------------------------------------------
    | Mix Asset Management https://laravel-mix.com/docs/6.0/api
    |--------------------------------------------------------------------------
    |
    | Mix provides a clean, fluent API for defining some Webpack build steps
    | for your Laravel application. By default, we are compiling the Sass
    | file for your application, as well as bundling up your JS files.
    |
 */

mix
    // Make sure the public path is declared
    .setPublicPath('public')
    .webpackConfig({
        module: {
            rules: [
                {
                    test: /\.svelte$/,
                    use: {
                        loader: 'svelte-loader',
                        options: {
                            preprocess: require('svelte-preprocess')(),
                            compilerOptions: {
                                customElement: true
                            }
                        }
                    }
                }
            ]
        },
        resolve: {
            extensions: ['.ts', '.js', '.svelte'],
            conditionNames: ['svelte', '...'],
            alias: {
                $libs: path.resolve(__dirname, 'resources/ts/libs/index.ts'),
                $types: path.resolve(__dirname, 'resources/ts/types/index.ts')
            }
        }
    })

    .options({
        terser: {
            extractComments: false
        }
    })

    // Simple ES6 JavaScript
    .js('resources/js/main.js', 'public/application/js/main.js')

    // CSS Compilation
    .sass('resources/css/main.scss', 'public/application/css/main.css');


    // compile svelte components
    for (const path of svelteComponents) {
        const source = `${path}/ts/index.ts`;
        const destination = `${path}/view.js`;
        mix.ts(source, destination);
    }
