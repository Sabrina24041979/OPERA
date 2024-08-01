document.addEventListener('DOMContentLoaded', function () {

    //on récup les elements et on initialise showPast à false
    const table = document.getElementById('interview-table');
    const toggleButton = document.getElementById('toggle-past-interviews');
    let showPast = false;

    //listener sur le bouton
    toggleButton.addEventListener('click', function () {
        //quand on clique, showPast devient l'inverse de ce qu'il est mnt
        showPast = !showPast;

        //on execute la fct filter
        filterTable();

        //on change en dynamique le txt du button avec showPast
        toggleButton.textContent = showPast ? 'Masquer les entretiens archivés' : 'Afficher les entretiens archivés';
    })

    function filterTable() {
        //instancie nouvel objet Date sans l'heure
        const today = new Date().toISOString().split('T')[0];

        //on stocke toutes les lignes du tbody
        const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            //boucle sur chaque ligne récupérée, on recup le contenu du champ Date
            const dateCell = rows[i].getElementsByTagName('td')[0];
            const interviewDate = dateCell.textContent;

            //on compare le contenu de chaque champ avec today
            if (showPast || interviewDate >= today) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    }

    filterTable();
});