// assets/admin.js

// Gestion des tableaux de données avec DataTables ou une autre bibliothèque
document.addEventListener('DOMContentLoaded', function() {
    $('#userTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/French.json"
        }
    });

    // Je sélectionne tous les boutons de configuration par leur classe
const configButtons = document.querySelectorAll('.config-edit');

// Je parcours chaque bouton pour y attacher un écouteur d'événements
configButtons.forEach(button => {
    button.addEventListener('click', function() {
        // Je récupère l'identifiant de la configuration à partir de l'attribut data-configId du bouton cliqué
        const configId = this.dataset.configId;

        // Je lance une requête fetch pour obtenir le formulaire de modification
        fetch(`/admin/settings/edit/${configId}`)
            .then(response => response.text())  // Je traite la réponse pour obtenir du HTML
            .then(html => {
                // J'insère le HTML dans le corps du modal
                document.getElementById('modal-config-body').innerHTML = html;
                // J'affiche le modal à l'utilisateur
                $('#configModal').modal('show');
            });
    });
});
});

