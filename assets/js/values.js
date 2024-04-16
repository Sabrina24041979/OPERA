// Ce fichier gère les interactions spécifiques à la page "Valeurs"
document.addEventListener('DOMContentLoaded', function() {
    console.log("La page 'Valeurs' est prête.");

    // Par exemple, gérer le survol des éléments pour afficher plus d'informations
    const valueCards = document.querySelectorAll('.value-card');
    valueCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            console.log("Survole d'une carte de valeur.");
            // Je peux ajouter des effets visuels ou des informations supplémentaires - A voir
        });
    });
});
