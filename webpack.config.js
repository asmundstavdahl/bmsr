var Encore = require('@symfony/webpack-encore');

Encore
    // the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    // uncomment to create hashed filenames (e.g. app.abc123.css)
    // .enableVersioning(Encore.isProduction())

    // uncomment to define the assets of the project
    .addEntry('js/shortcuts', './assets/js/shortcuts.js')
    .addEntry('css/sakura', './assets/css/sakura.css')
    // .addStyleEntry('css/app', './assets/css/app.scss')
    
    .addEntry('css/normalize', './node_modules/Skeleton/css/normalize.css')
    .addEntry('css/skeleton', './node_modules/Skeleton/css/skeleton.css')
    
    .addEntry('js/quick-select', './assets/js/quick-select.js')

    // uncomment if you use Sass/SCSS files
    // .enableSassLoader()

    // uncomment for legacy applications that require $/jQuery as a global variable
    // .autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
