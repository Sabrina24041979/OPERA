// assets/manager_l1.js

// Gestion des modalités pour la création ou l'édition d'objectifs
document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.edit-objective');
    editButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            const objectiveId = this.dataset.objectiveId;
            // Logique pour charger les détails de l'objectif dans un modal
            fetch(`/manager/level1/objective/edit/${objectiveId}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('modal-body').innerHTML = html;
                    $('#editModal').modal('show');
                });
        });
    });

    // Équivalent pour la création d'actions, etc.
});

