// Je sélectionne tous les éléments qui nécessitent une interaction AJAX pour marquer comme lu
document.querySelectorAll('.mark-as-read').forEach(button => {
    button.addEventListener('click', function() {
        const notificationId = this.dataset.notificationId;

        fetch(`/notifications/${notificationId}/read`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'  // Nécessaire si tu utilises Symfony pour gérer les requêtes AJAX
            },
            body: JSON.stringify({ status: 'read' })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Notification marquée comme lue');
                // Je peux aussi modifier l'interface utilisateur ici pour refléter le changement
                this.parentNode.style.textDecoration = 'line-through';
            }
        })
        .catch(error => console.error('Erreur AJAX :', error));
    });
});
