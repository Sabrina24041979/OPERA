// Je m'assure que le DOM est entièrement chargé avant de manipuler les éléments
document.addEventListener('DOMContentLoaded', function() {
    // Je sélectionne tous les éléments qui représentent les titres des sections d'aide
    const helpTitles = document.querySelectorAll('.help-widget h3');

    // Je boucle sur chaque titre pour y ajouter un gestionnaire d'événement
    helpTitles.forEach(title => {
        title.addEventListener('click', function() {
            // Je bascule la classe 'active' qui contrôle l'affichage du contenu associé
            this.classList.toggle('active');
            // Je récupère le prochain élément frère (le contenu) et je bascule sa visibilité
            let content = this.nextElementSibling;
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
        });
    });
});
