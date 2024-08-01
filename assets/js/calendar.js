// import 'bootstrap/dist/css/bootstrap.css';
// import 'bootstrap/dist/js/bootstrap.bundle';

import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'; // pour les interactions comme le clic
import frLocale from '@fullcalendar/core/locales/fr'; // Importer la localisation française

document.addEventListener('DOMContentLoaded', function () {
    console.log('Calendar script loaded');
    const calendarEl = document.getElementById('calendar');
    let events = window.calendarEvents;
    if (calendarEl) {
        const calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin, interactionPlugin, timeGridPlugin],
            initialView: 'timeGridWeek',
            locale: frLocale,
            timeZone: 'Europe/Paris',
            headerToolbar: {
                start: 'dayGridMonth,timeGridWeek,timeGridDay',
                center: 'title',
                end: 'prev,next'
            },
            footerToolbar: {
                start: '',
                center: 'today',
                end: ''
            },
            height: 'auto',
            weekNumbers: true,
            weekNumberFormat: { week: 'numeric' },
            firstDay: 1,
            nowIndicator: true,
            slotMinTime: "08:00:00",
            slotMaxTime: "20:00:00",
            // weekends: false, //uncomment this line to hide Saturday/Sunday from calendar
            //hiddenDays: [0, 1, 2, 3...], //uncomment to customize hidden days (0 = sunday, 1 = monday...)
            //allDaySlot: false, //uncomment to hide "all-day" slot at top of calendar
            events: events,
            eventClick: function (info) {
                let eventObj = info.event;

                fetch('/interview/details/' + eventObj.id) //recup url de la route
                    .then(response => response.json()) //envoie la reponse en json
                    .then(data => { //passe les infos necessaires à afficher
                        // console.log(data);
                        //data = objet sur lequel on a cliqué, identifié par eventObj.id
                        document.getElementById('interviewTitle').textContent = data.name || 'Inconnu';
                        document.getElementById('interviewDate').textContent = data.date || 'Inconnu';
                        document.getElementById('interviewee').textContent = data.username || 'Inconnu';
                        document.getElementById('interviewDuration').textContent = `${data.duration} minutes` || 'Inconnu';
                        document.getElementById('interviewStatus').textContent = data.status || 'Inconnu';

                        //ici on recup id du bouton modifier et on change id de url en dynamique avec eventObj.id
                        let editButton = document.getElementById('editInterview');
                        editButton.href = '/interview/' + eventObj.id + '/edit';

                        //ici on affiche la modale avec bootstrap dans la div interviewModal
                        let interviewModal = new bootstrap.Modal(document.getElementById('interviewModal')); //affichage modale dans cet element
                        interviewModal.show();
                    })
                    .catch(error => console.error('Error : ', error)); //gestion de l'erreur
            }
        });
        calendar.render();
    } else {
        console.error('Calendar element not found in the DOM');
    }
});


//dayGrid = affiche pur
//timeGrid = affichage avec les heures
//timeGridDay / timeGridMonth / timeGridWeek = affichage jour, mois, semaine
//on peut lui passer autant de paramètres que l'on veut pour influer sur affichage des infos
