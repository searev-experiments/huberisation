var Encore = require('@symfony/webpack-encore');

Encore
// the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    // uncomment to create hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    /*
     * Add JS
     */
     .addEntry('js/nav', './assets/js/nav.js')

    /*
     * Add CSS / SCSS
     */
    .addStyleEntry('css/base', './assets/scss/base.scss')
    .addStyleEntry('css/markdown', './assets/scss/markdown.scss')
    .addStyleEntry('css/nav', './assets/scss/nav.scss')
    .addStyleEntry('css/footer', './assets/scss/footer.scss')
    .addStyleEntry('css/error', './assets/scss/error.scss')
    .addStyleEntry('css/accueil', './assets/scss/accueil.scss')
    .addStyleEntry('css/blog', './assets/scss/blog.scss')
    .addStyleEntry('css/tutoriels', './assets/scss/tutoriels.scss')
    .addStyleEntry('css/projets', './assets/scss/projets.scss')
    .addStyleEntry('css/article', './assets/scss/article.scss')
    .addStyleEntry('css/a-propos', './assets/scss/a-propos.scss')
    .addStyleEntry('css/login', './assets/scss/login.scss')
    .addStyleEntry('css/admin-list', './assets/scss/admin-list.scss')
    .addStyleEntry('css/form', './assets/scss/form.scss')
    .addStyleEntry('css/article-thumbnail', './assets/scss/article-thumbnail.scss')
    .addStyleEntry('css/tutoriel-thumbnail', './assets/scss/tutoriel-thumbnail.scss')
    .addStyleEntry('css/project-thumbnail', './assets/scss/project-thumbnail.scss')

    // uncomment if you use Sass/SCSS files
    .enableSassLoader()

    // uncomment for legacy applications that require $/jQuery as a global variable
    .autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
