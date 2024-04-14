// Je gère la soumission du formulaire pour ajouter ou modifier les ressources
document.addEventListener('DOMContentLoaded', function() {
    const resourceForm = document.getElementById('resource-form');

    if (resourceForm) {
        resourceForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);

            // Je fais une requête AJAX pour envoyer les données du formulaire
            fetch(this.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Je gère la réponse positive, par exemple en affichant un message ou en actualisant la liste des ressources
                    console.log('Ressource ajoutée ou mise à jour avec succès !');
                } else {
                    // Je gère les erreurs potentielles, qui peuvent être retournées par le serveur
                    console.error('Erreur lors de l\'ajout ou de la mise à jour de la ressource.');
                }
            })
            .catch(error => console.error('Erreur AJAX : ', error));
        });
    }
});
