document.addEventListener('DOMContentLoaded', function () {

    //check logged user
    if (isUserConnected) {
        const lastReminder = localStorage.getItem('lastReminder');
        const oneWeek = 7 * 24 * 60 * 60 * 1000;
        const now = new Date().getTime();

        if (!lastReminder || now - lastReminder > oneWeek) {
            let reminderModal = new bootstrap.Modal(document.getElementById('reminderModal'));
            reminderModal.show();

            localStorage.setItem('lastReminder', now);
        }
    }
});