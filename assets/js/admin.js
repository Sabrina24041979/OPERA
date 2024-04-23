// assets/admin.js

// Gestion des tableaux de données avec DataTables ou une autre bibliothèque
document.addEventListener('DOMContentLoaded', function() {
    $('#userTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/French.json"
        }
    });

    // Dialogues modaux pour la modification rapide des permissions ou des configurations
    const configButtons = document.querySelectorAll('.config-edit');
    configButtons.forEach(button => {
        button.addEventListener('click', function() {
            const configId = this.dataset.configId;
            fetch(`/admin/settings/edit/${configId}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('modal-config-body').innerHTML = html;
                    $('#configModal').modal('show');
                });
        });
    });
});

