// Je gère les interactions spécifiques pour l'interface du manager de niveau 1

document.addEventListener('DOMContentLoaded', function() {
    // Je configure les écouteurs d'événements pour les boutons et autres éléments interactifs
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function(event) {
            if (!confirm("Êtes-vous sûr de vouloir supprimer cet élément ?")) {
                event.preventDefault();
            }
        });
    });

    // Je gère l'ouverture des modales pour la création et l'édition des profils
    const openModalButtons = document.querySelectorAll('[data-toggle="modal"]');
    openModalButtons.forEach(button => {
        button.addEventListener('click', function() {
            const modalSelector = this.getAttribute('data-target');
            const modalElement = document.querySelector(modalSelector);
            modalElement.style.display = 'block'; // Je montre la modale
        });
    });

    // Je gère la fermeture des modales
    const closeModalButtons = document.querySelectorAll('[data-dismiss="modal"]');
    closeModalButtons.forEach(button => {
        button.addEventListener('click', function() {
            const modalElement = this.closest('.modal');
            modalElement.style.display = 'none'; // Je cache la modale
        });
    });

    // Je pourrais ajouter d'autres fonctionnalités JavaScript selon les besoins
});
