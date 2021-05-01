const mix = require('laravel-mix');

mix.ts('resources/ts/app.ts', 'public/js/app.js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .browserSync({
        proxy: {
            target: 'http://localhost',
        },
        files: [
            './resources/**/*',
            './public/**/*',
        ],
        open: false,
        reloadOnRestart: true,
    });
