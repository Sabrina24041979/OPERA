const rules = [
  {
    test: /\.css$/,
    use: [
      'style-loader',
      'css-loader'
    ]
  },
  // Autres chargeurs pour JavaScript, images, etc.
];

const Encore = require('@symfony/webpack-encore');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
  Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
  // directory where compiled assets will be stored
  .setOutputPath('public/build/')
  // public path used by the web server to access the output path
  .setPublicPath('/build')
  // only needed for CDN's or subdirectory deploy
  //.setManifestKeyPrefix('build/')

  /*
   * ENTRY CONFIG
   *
   * Each entry will result in one JavaScript file (e.g. app.js)
   * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
   */
  .addEntry('app', './assets/app.js')

  .addStyleEntry('bootstrap', './node_modules/bootstrap/dist/css/bootstrap.css')
  .addStyleEntry('calendar', './assets/styles/calendar.scss') // Créer ce fichier pour qu'il importe les styles de FullCalendar.

  .addEntry('notification', './assets/js/notification.js') // Ajoute notification.js comme une nouvelle entrée
  .addStyleEntry('notification-style', './assets/styles/notification.css') // Ajoute notification.css comme une entrée de style
  .addStyleEntry('bootstrap-table-style', './assets/styles/bootstrap-table.css')
  // .addEntry('block_user','./assets/styles/block_user.scss')
  // .addStyleEntry('base-bo', './assets/styles/base_bo.css') // Ajoute base_bo.css comme une entrée de style

  // // .addStyleEntry('home-style', './assets/styles/home.scss')
  // // .addEntry('home', './assets/home.js') // Assurez-vous que le chemin et le fichier existent
  // .addStyleEntry('home', './assets/styles/home.scss') // Cette ligne est dupliquée, renommez ou supprimez-la
  .addEntry('calendarjs', './assets/js/calendar.js')
  .addEntry('jquery', './assets/js/jquery.js')
  .addEntry('bootstrap-table', './assets/js/bootstrap-table.js')
  .addEntry('pastInterview', './assets/js/pastInterviews.js') //fichier js sur affichage interviews archivées
  .addEntry('weeklyReminder', './assets/js/weeklyReminder.js') //fichier js pour rappel de décla sentiments + charge travail  .addEntry('notif', ['/assets/js/notif.js','/assets/styles/notif.scss'])
  .addEntry('modal', ['./assets/styles/modal.scss', './assets/js/modal.js'])
  .addEntry('notif', ['/assets/js/notif.js', '/assets/styles/notif.scss'])
  .addEntry('block_user', './assets/styles/block_user.scss')

  // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
  .splitEntryChunks()

  // enables the Symfony UX Stimulus bridge (used in assets/bootstrap.js)
  .enableStimulusBridge('./assets/controllers.json')

  // enables the Symfony UX Stimulus bridge (used in assets/bootstrap.js)
  .enableStimulusBridge('./assets/controllers.json')

  // will require an extra script tag for runtime.js
  // but, you probably want this, unless you're building a single-page app
  .enableSingleRuntimeChunk()

  /*
   * FEATURE CONFIG
   *
   * Enable & configure other features below. For a full
   * list of features, see:
   * https://symfony.com/doc/current/frontend.html#adding-more-features
   */
  .cleanupOutputBeforeBuild()
  .enableBuildNotifications()
  .enableSourceMaps(!Encore.isProduction())
  // enables hashed filenames (e.g. app.abc123.css)
  .enableVersioning(Encore.isProduction())

  // configure Babel
  // .configureBabel((config) => {
  //     config.plugins.push('@babel/a-babel-plugin');
  // })

  // enables and configure @babel/preset-env polyfills
  .configureBabelPresetEnv((config) => {
    config.useBuiltIns = 'usage';
    config.corejs = '3.23';
  })

  // enables Sass/SCSS support
  .enableSassLoader() // Je décommente cette ligne pour activer le support Sass/SCSS.

  // uncomment if you use TypeScript
  //.enableTypeScriptLoader()

  // uncomment if you use React
  //.enableReactPreset()

  // uncomment to get integrity="..." attributes on your script & link tags
  // requires WebpackEncoreBundle 1.4 or higher
  //.enableIntegrityHashes(Encore.isProduction())

  // uncomment if you're having problems with a jQuery plugin
  .autoProvidejQuery()
  ;

module.exports = Encore.getWebpackConfig();