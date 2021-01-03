const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

const distPath = 'public/dist';

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/custom/scss/custom.scss', 'public/css')
    .copy('resources/custom/js', 'public/js')
    .copy('resources/custom/img', 'public/img')
    .copy('resources/custom/fonts', 'public/fonts')

    .copy('resources/custom/js/image-uploader.js', 'public/js')


    // +==================================
    // |
    // |   Local package for production    
    // |
    // +==================================
    
    // + bootstrap
    .copy('node_modules/bootstrap/dist', `${distPath}/bootstrap`)

    // fontawesome
    .copy('node_modules/@fortawesome/fontawesome-free/css', `${distPath}/fontawesome/css`)
    .copy('node_modules/@fortawesome/fontawesome-free/webfonts', `${distPath}/fontawesome/webfonts`)
    
    // owl-carousel
    .copy('node_modules/owl.carousel', `${distPath}`)

    // sweetalert2
    .copy('node_modules/sweetalert2', `${distPath}/sweetalert2`)

    // chart js
    .copy('node_modules/chart.js', `${distPath}/chart.js`)

    // nicescroll
    .copy('node_modules/jquery.nicescroll/dist', `${distPath}/nicescroll`)
    
    // popper js
    .copy('node_modules/@popperjs/core', `${distPath}/popperjs`)
    
    // datatable.net
    .copy('node_modules/datatables.net', `${distPath}/datatable/datatable.net`)

    // datatable.net bootstrap 4
    .copy('node_modules/datatables.net-bs4', `${distPath}/datatable/datatables.net-bs4`)
    
    // chocolat js
    .copy('node_modules/chocolat', `${distPath}/chocolat`)

    // daterangepicker 
    .copy('node_modules/daterangepicker', `${distPath}/daterangepicker`)
    
    // moment js 
    .copy('node_modules/moment', `${distPath}/moment`);
