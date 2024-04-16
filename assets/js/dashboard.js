// Je définis les interactions sur le tableau de bord
document.addEventListener('DOMContentLoaded', function () {
    // Je gère les clics sur les boutons du tableau de bord
    const buttons = document.querySelectorAll('.dashboard-btn');
    buttons.forEach(button => {
        button.addEventListener('click', function () {
            // Je peux ajouter ici une logique pour gérer des pop-ups ou des modifications d'éléments
            alert("Je gère les interactions du tableau de bord!");
        });
    });

    // Je peux ajouter des requêtes AJAX pour charger ou mettre à jour des données sans recharger la page
    function loadDashboardData() {
        fetch('/api/dashboard/data')
            .then(response => response.json())
            .then(data => {
                console.log("Je charge dynamiquement les données du tableau de bord:", data);
            })
            .catch(error => console.error('Erreur lors du chargement des données:', error));
    }

    // Je charge les données initiales
    loadDashboardData();
});
