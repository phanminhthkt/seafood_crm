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

// mix.js('resources/js/app.js', 'public/js')
//     .vue()
//     .sass('resources/sass/app.scss', 'public/css').js('node_modules/popper.js/dist/popper.js', 'public/js').sourceMaps();;
mix.js('public/backend/libs/handlebars/handlebars.js', 'public/backend/js/app.all.js')
    .js('public/backend/libs/multiselect/jquery.multi-select.js', 'public/backend/js/app.all.js')
    .js('public/backend/libs/select2/select2.min.js', 'public/backend/js/app.all.js')
    .js('public/backend/libs/bootstrap-select/bootstrap-select.min.js', 'public/backend/js/app.all.js')
    .js('public/backend/libs/switchery/switchery.min.js', 'public/backend/js/app.all.js')
    .js('public/backend/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js', 'public/backend/js/app.all.js')
    .js('public/backend/js/pages/Chart.min.js', 'public/backend/js/app.all.js')
    .js('public/backend/js/pages/form-advanced.init.js', 'public/backend/js/app.all.js')
    .js('public/backend/libs/sweetalert2/sweetalert2.js', 'public/backend/js/app.all.js')
    .js('public/backend/libs/flatpickr/flatpickr.min.js', 'public/backend/js/app.all.js')
    .js('public/backend/libs/jquery-mask-plugin/jquery.mask.min.js', 'public/backend/js/app.all.js')
    .js('public/backend/libs/ion-rangeslider/ion.rangeSlider.min.js', 'public/backend/js/app.all.js');


// mix.postCss('public/backend/libs/datatables/dataTables.bootstrap4.css', 'public/backend/css/app.all.css')
//    .postCss('public/backend/css/bootstrap.min.css', 'public/backend/css/app.all.css')
//    .postCss('public/backend/libs/switchery/switchery.min.css', 'public/backend/css/app.all.css')
//    .postCss('public/backend/libs/dropzone/dropzone.min.css', 'public/backend/css/app.all.css')
//    .postCss('public/backend/libs/multiselect/multi-select.css', 'public/backend/css/app.all.css')
//    .postCss('public/backend/libs/bootstrap-select/bootstrap-select.min.css', 'public/backend/css/app.all.css')
//    .postCss('public/backend/libs/select2/select2.min.css', 'public/backend/css/app.all.css')
//    .postCss('public/backend/libs/sweetalert2/sweetalert2.css', 'public/backend/css/app.all.css')
//    .postCss('public/backend/libs/flatpickr/flatpickr.min.css', 'public/backend/css/app.all.css')
