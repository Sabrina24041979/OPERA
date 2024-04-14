import { startStimulusApp } from '@symfony/stimulus-bridge';

// Initialisation de l'application Stimulus pour charger les contrôleurs
export const app = startStimulusApp(require.context(
    './controllers', // Chemin relatif au dossier des contrôleurs
    true, // Recherche récursive dans les sous-dossiers
    /\.[jt]sx?$/, // Prise en compte des fichiers JavaScript et TypeScript
));

// Enregistrez des contrôleurs personnalisés tiers ici
// app.register('some_controller_name', SomeImportedController);