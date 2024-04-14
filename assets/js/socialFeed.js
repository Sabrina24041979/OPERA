// Je définis les fonctions pour interagir avec le mur social via AJAX
document.addEventListener('DOMContentLoaded', function() {
    const postForm = document.getElementById('postForm'); // Je récupère le formulaire d'ajout de post

    postForm.addEventListener('submit', function(event) {
        event.preventDefault(); // J'empêche le rechargement de la page
        const formData = new FormData(postForm); // Je construis les données du formulaire

        fetch('/path-to-your-post-api', { // Je fais une requête POST vers l'API de création de post
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Post ajouté avec succès!');
                location.reload(); // Je recharge la page pour afficher le nouveau post (ou je pourrais ajouter le post dynamiquement sans recharger)
            } else {
                alert('Erreur lors de l\'ajout du post');
            }
        })
        .catch(error => console.error('Erreur AJAX:', error));
    });
});
