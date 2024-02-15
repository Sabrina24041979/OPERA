import { startStimulusApp } from '@symfony/stimulus-bundle';

// Déclaration de la variable app
const app = startStimulusApp();

// Charger les contrôleurs dynamiquement à partir de controllers.json et du dossier controllers/
export const lazyApp = startStimulusApp(require.context(
    '@symfony/stimulus-bridge/lazy-controller-loader!./controllers',
    true,
    /\.[jt]sx?$/
));
// Enregistrez des contrôleurs personnalisés tiers ici
// app.register('some_controller_name', SomeImportedController);